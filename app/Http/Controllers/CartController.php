<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('clients.cart', compact('cart', 'total'));
    }

    // Ajouter un produit au panier
    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::where('id', $id)
                    ->where('is_active', 1) // ← Produit doit être actif
                    ->where('quantity', '>', 0) // ← Et avoir du stock
                    ->firstOrFail();
        
        $cart = Session::get('cart', []);
        $quantity = $request->quantity;
        
        // Vérifier si la quantité demandée est disponible
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Quantité non disponible. Stock restant: ' . $product->quantity);
        }

        // Vérifier si le produit est déjà dans le panier
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            
            // Vérifier que le total ne dépasse pas le stock
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
                'max_quantity' => $product->quantity // Stock maximum disponible
            ];
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Mettre à jour la quantité
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $newQuantity = $request->quantity;
        
        if (isset($cart[$id])) {
            // Vérifier que la nouvelle quantité ne dépasse pas le stock
            if ($newQuantity > $cart[$id]['max_quantity']) {
                return redirect()->back()->with('error', 'Quantité non disponible. Stock maximum: ' . $cart[$id]['max_quantity']);
            }
            
            $cart[$id]['quantity'] = $newQuantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Panier mis à jour !');
    }

    // Supprimer un produit du panier
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produit retiré du panier !');
    }

    // Vider le panier
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Panier vidé !');
    }
}