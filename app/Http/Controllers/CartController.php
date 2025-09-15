<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('clients.cart', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Optimisation: Select spécifique
        $product = Product::where('id', $id)
                    ->where('is_active', 1)
                    ->where('quantity', '>', 0)
                    ->select('id', 'name', 'price', 'front_image', 'quantity')
                    ->firstOrFail();
        
        $cart = Session::get('cart', []);
        $quantity = $request->quantity;
        
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Quantité non disponible. Stock restant: ' . $product->quantity);
        }

        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            
            if ($newQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'Vous ne pouvez pas ajouter plus que le stock disponible. Stock restant: ' . ($product->quantity - $cart[$id]['quantity']));
            }
            
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'front_image' => $product->front_image,
                'max_quantity' => $product->quantity
            ];
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $newQuantity = $request->quantity;
        
        if (isset($cart[$id])) {
            if ($newQuantity > $cart[$id]['max_quantity']) {
                return redirect()->back()->with('error', 'Quantité non disponible. Stock maximum: ' . $cart[$id]['max_quantity']);
            }
            
            $cart[$id]['quantity'] = $newQuantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Panier mis à jour !');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produit retiré du panier !');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Panier vidé !');
    }
}