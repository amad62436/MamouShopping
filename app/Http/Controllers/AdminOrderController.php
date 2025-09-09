<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Compteur de commandes en attente (pour les notifications)
    public function pendingCount()
    {
        $count = Order::where('status', 'pending')->count();
        
        return response()->json(['count' => $count]);
    }
    
    // Liste des commandes en attente
    public function pending()
    {
        $orders = Order::with(['user', 'items.product'])
                      ->where('status', 'pending')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('admin.orders.pending', compact('orders'));
    }

    // Valider une commande (stocks déjà diminués, on ne fait rien de plus)
    public function approve($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        try {
            // Vérifier le stock avant validation (au cas où)
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if (!$product) {
                    return redirect()->back()->with('error', 'Produit non trouvé: #' . $item->product_id);
                }
            }

            // Générer la facture
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'invoice_number' => Invoice::generateInvoiceNumber(),
                'total_amount' => $order->total_amount,
                'issued_at' => now(),
            ]);

            // Mettre à jour la commande
            $order->update([
                'status' => 'paid',
                'payment_status' => 'confirmed',
                'invoice_generated' => true,
            ]);

            return redirect()->back()->with('success', 'Commande validée et facture générée!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Refuser une commande et RESTAURER LES STOCKS
    public function reject($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        
        try {
            // RESTAURER LES STOCKS pour chaque article
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->quantity += $item->quantity;
                    $product->save();
                }

                // Réactiver le produit si nécessaire
                if ($product->quantity > 0 && !$product->is_active) {
                    $product->is_active = true;
                    $product->save();
                }
            }

            // Mettre à jour la commande
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'failed',
            ]);

            return redirect()->back()->with('success', 'Commande annulée et stocks restaurés!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'annulation: ' . $e->getMessage());
        }
    }

    // Toutes les commandes
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'invoice'])
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Détails d'une commande (optionnel)
    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'invoice'])
                     ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}