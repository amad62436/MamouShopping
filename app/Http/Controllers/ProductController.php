<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // Enregistrer un nouveau produit
    public function saveproduct(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'type.required' => 'Le type de produit est obligatoire.',
            'price.required' => 'Le prix du produit est obligatoire.',
            'quantity.required' => 'La quantité est obligatoire.',
            'category_id.required' => 'La catégorie est obligatoire.',
            '*.image' => 'Le fichier doit être une image valide.',
            '*.mimes' => 'Seuls les formats jpeg, png, jpg et gif sont acceptés.',
            '*.max' => 'L\'image ne doit pas dépasser 2Mo.',
        ]);

        try {
            // Création du produit
            $product = new Product();
            $product->name = $validatedData['name'];
            $product->type = $validatedData['type'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->prix_barre = $validatedData['prix_barre'];
            $product->quantity = $validatedData['quantity'];
            $product->category_id = $validatedData['category_id'];

            // Formatage du nom de fichier
            $fileName = Str::slug($validatedData['name']); // Convertit le nom en format URL-friendly
            $timestamp = now()->timestamp; // Ajout d'un timestamp pour l'unicité

            // Gestion de l'image de face
            if ($request->hasFile('front_image')) {
                $frontExtension = $request->file('front_image')->extension();
                $frontFileName = "{$fileName}-front-{$timestamp}.{$frontExtension}";
                $frontPath = $request->file('front_image')->storeAs('products', $frontFileName, 'public');
                $product->front_image = $frontPath;
            }

            // Gestion de l'image de l'arrière
            if ($request->hasFile('back_image')) {
                $backExtension = $request->file('back_image')->extension();
                $backFileName = "{$fileName}-back-{$timestamp}.{$backExtension}";
                $backPath = $request->file('back_image')->storeAs('products', $backFileName, 'public');
                $product->back_image = $backPath;
            }

            // Enregistrement en base de données
            $product->save();

            return redirect('/admin/produits_list')
                ->with('status', 'Produit ajouté avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout: ' . $e->getMessage());
        }
    }

    // Afficher le formulaire d'édition
    public function editproduct($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.editproduct', compact('product', 'categories'));
    }

    // Mettre à jour un produit
    public function updateproduct(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'type.required' => 'Le type de produit est obligatoire.',
            'price.required' => 'Le prix du produit est obligatoire.',
            'quantity.required' => 'La quantité est obligatoire.',
            'category_id.required' => 'La catégorie est obligatoire.',
            '*.image' => 'Le fichier doit être une image valide.',
            '*.mimes' => 'Seuls les formats jpeg, png, jpg et gif sont acceptés.',
            '*.max' => 'L\'image ne doit pas dépasser 2Mo.',
        ]);

        $product = Product::findOrFail($id);
        $originalData = $product->getOriginal();

        try {
            // Mise à jour des champs de base
            $product->name = $validatedData['name'];
            $product->type = $validatedData['type'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->prix_barre = $validatedData['prix_barre'];
            $product->quantity = $validatedData['quantity'];
            $product->category_id = $validatedData['category_id'];

            $fileName = Str::slug($validatedData['name']);
            $timestamp = now()->timestamp;

            // Gestion de l'image de face
            if ($request->hasFile('front_image')) {
                // Supprime l'ancienne image si elle existe
                if ($product->front_image) {
                    Storage::disk('public')->delete($product->front_image);
                }
                
                $frontPath = $request->file('front_image')
                    ->storeAs(
                        'products',
                        $fileName.'-front-'.$timestamp.'.'.$request->file('front_image')->extension(),
                        'public'
                    );
                $product->front_image = $frontPath;
            }

            // Gestion de l'image de l'arrière
            if ($request->hasFile('back_image')) {
                // Supprime l'ancienne image si elle existe
                if ($product->back_image) {
                    Storage::disk('public')->delete($product->back_image);
                }
                
                $backPath = $request->file('back_image')
                    ->storeAs(
                        'products',
                        $fileName.'-back-'.$timestamp.'.'.$request->file('back_image')->extension(),
                        'public'
                    );
                $product->back_image = $backPath;
            }

            $product->save();

            return redirect('/admin/produits_list')
                ->with('status', 'Produit mis à jour avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: '.$e->getMessage());
        }
    }

    // Supprimer un produit
    public function deleteproduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // La suppression des images se fera automatiquement via l'event deleting
            $product->delete();

            return redirect('/admin/produits_list')
                ->with('status', 'Produit supprimé avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression: '.$e->getMessage());
        }
    }
} 