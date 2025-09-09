<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    // Afficher le formulaire de commande
    public function create()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Vérifier le stock avant de commander
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Stock insuffisant pour ' . $item['name'] . '. Stock disponible: ' . ($product->quantity ?? 0));
            }
        }

        return view('clients.checkout', compact('cart'));
    }

    // Traiter la commande (diminuer la quantité immédiatement)
    public function store(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Validation
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_number' => 'required|string|max:20',
        ]);

        // Vérification finale des stocks avant de créer la commande
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            
            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Produit non trouvé: ' . $item['name']);
            }
            
            if ($product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Stock insuffisant pour ' . $item['name'] . '. Stock disponible: ' . $product->quantity);
            }
        }

        try {
            // Calculer le total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Créer la commande avec statut "pending"
            $order = Order::create([
                'user_id' => Auth::id() ?? 1,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_number' => $request->payment_number,
                'payment_status' => 'pending',
                'invoice_generated' => false,
            ]);

            // Créer les articles de la commande et mettre à jour les stocks (DIMINUTION IMMÉDIATE)
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Mettre à jour le stock du produit (DIMINUTION IMMÉDIATE)
                $product = Product::find($item['id']);
                $product->quantity -= $item['quantity'];
                $product->save();

                // Vérifier et désactiver si stock = 0
                $product->updateStatusBasedOnStock();
            }

            // Vider le panier
            Session::forget('cart');

            return redirect()->route('orders.confirmation', $order->id)
                           ->with('success', 'Commande passée avec succès! En attente de validation du paiement.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Page de confirmation
    public function confirmation($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('clients.order_confirmation', compact('order'));
    }

    // Historique des commandes
    public function index()
    {
        $orders = Order::with(['items.product', 'invoice'])
                  ->orderBy('created_at', 'desc')
                  ->paginate(10);

        return view('clients.orders', compact('orders'));
    }

    // Détails d'une commande
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('clients.order_details', compact('order'));
    }
}