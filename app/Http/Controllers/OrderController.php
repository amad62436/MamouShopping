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
    // SUPPRIMEZ le constructeur, on utilise le middleware dans les routes
    
    public function create()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Stock insuffisant pour ' . $item['name']);
            }
        }

        return view('clients.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_number' => 'required|string|max:20',
        ]);

        // Vérification stock
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Stock insuffisant pour ' . $item['name']);
            }
        }

        try {
            // Création commande
            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_number' => $request->payment_number,
                'payment_status' => 'pending',
            ]);

            // Création items et mise à jour stock
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product = Product::find($item['id']);
                $product->decrement('quantity', $item['quantity']);
            }

            Session::forget('cart');
            return redirect()->route('orders.confirmation', $order->id);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function confirmation($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items.product')->findOrFail($id);
        return view('clients.order_confirmation', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                  ->with(['items.product', 'invoice'])
                  ->orderBy('created_at', 'desc')
                  ->paginate(10);

        return view('clients.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items.product')->findOrFail($id);
        return view('clients.order_details', compact('order'));
    }
}