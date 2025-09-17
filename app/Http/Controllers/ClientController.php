<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    //Affichage des catégories sur la page d'accueil - OPTIMISÉ MAIS COMPLET
    public function home(){
        $categories = Cache::remember('home_categories', 3600, function () {
            return Category::optimized()
                         ->where('is_active', 1)
                         ->select('id', 'name', 'slug', 'image')
                         ->orderBy('name', 'asc')
                         ->get();
        });
        
        $products = Cache::remember('home_products', 1800, function () {
            return Product::optimized()
                     ->where('is_active', 1)
                     ->where('quantity', '>', 0)
                     ->select('id', 'name', 'price', 'front_image', 'back_image', 'prix_barre', 'description',  'slug', 'quantity') // AJOUT DE quantity
                     ->orderBy('name', 'asc')
                     ->get();
        });

        return view('clients.home', compact('categories', 'products'));
    }

    public function account()
    {
        $user = Auth::user();
        return view('clients.account', compact('user'));
    }

    public function wishlist()
    {
        return view('clients.wishlist');
    }

    /**
     * Afficher le formulaire d'édition du profil
     */
    public function editAccount()
    {
        $user = Auth::user();
        return view('clients.edit_account', compact('user'));
    }

    /**
     * Mettre à jour les informations du profil
     */
    public function updateAccount(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ]);

        try {
            $user->update($validatedData);
            return redirect()->route('client.account')->with('success', 'Profil mis à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    /**
     * Afficher le formulaire de changement de mot de passe
     */
    public function showChangePasswordForm()
    {
        return view('clients.change_password');
    }

    /**
     * Mettre à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
         /** @var User $user */
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            $validator->errors()->add('current_password', 'Le mot de passe actuel est incorrect.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('client.account')->with('success', 'Mot de passe modifié avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification du mot de passe: ' . $e->getMessage());
        }
    }

    //Affichage des produits par catégorie sur une page spécifique - CORRIGÉ
     public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)
                          ->select('id', 'name', 'slug')
                          ->orderBy('name', 'asc')
                          ->firstOrFail();
        
        $products = Product::where('category_id', $category->id)
                          ->where('is_active', 1)
                          ->where('quantity', '>', 0)
                          ->select('id', 'name', 'price', 'front_image', 'back_image', 'prix_barre', 'slug', 'description', 'quantity') // AJOUT DE quantity
                          ->orderBy('name', 'asc')
                          ->get();
        
        return view('clients.category_products', compact('category', 'products'));
    }

    public function shop1()
    {
        $products = Product::where('type', ProductController::TYPE_NUMERIQUE)
                        ->where('is_active', 1)
                        ->where('quantity', '>', 0)
                        ->select('id', 'name', 'price', 'front_image','back_image', 'prix_barre', 'slug', 'description', 'quantity') // AJOUT DE quantity
                        ->orderBy('name', 'asc')
                        ->get();
        
        return view('clients.shop1', compact('products'));
    }

    public function shop2()
    {
        $products = Product::where('type', ProductController::TYPE_COSMETIQUE)
                        ->where('is_active', 1)
                        ->where('quantity', '>', 0)
                        ->select('id', 'name', 'price', 'front_image', 'back_image', 'prix_barre', 'slug', 'description', 'quantity') // AJOUT DE quantity
                        ->orderBy('name', 'asc')
                        ->get();
        
        return view('clients.shop2', compact('products'));
    }

    public function shop3()
    {
        $products = Product::where('type', ProductController::TYPE_AUTRE)
                        ->where('is_active', 1)
                        ->where('quantity', '>', 0)
                        ->select('id', 'name', 'price', 'front_image', 'back_image', 'prix_barre', 'slug', 'description', 'quantity') // AJOUT DE quantity
                        ->orderBy('name', 'asc')
                        ->get();
        
        return view('clients.shop3', compact('products'));
    }

    public function cart(){
        return view('clients.cart');
    }

    public function register(){
        return view('clients.register');
    }

    public function login(){
        return view('clients.login');
    }

    
    public function contact(){
        return view('clients.contact');
    }

    public function productDetail($id)
    {
        $product = Product::select('id', 'name', 'description', 'price', 'prix_barre', 'front_image', 'back_image', 'quantity', 'category_id')
                        ->findOrFail($id);
        return view('clients.product_detail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->where('is_active', 1)
                          ->select('id', 'name', 'price', 'front_image', 'back_image', 'prix_barre', 'description', 'link', 'slug', 'quantity') // AJOUT DE quantity
                          ->get();
        
        return view('clients.search_results', compact('products', 'query'));
    }
}