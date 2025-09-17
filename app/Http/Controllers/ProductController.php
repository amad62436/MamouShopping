<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    const TYPE_NUMERIQUE = 'Numérique';
    const TYPE_COSMETIQUE = 'Cosmétique';
    const TYPE_AUTRE = 'Autre';
    
    // Afficher la liste des produits
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.produits_list', compact('products'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $categories = Category::where('is_active', 1)
                                ->orderBy('name', 'asc')
                                ->get();
        return view('admin.addproduct', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function saveproduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:500',
            'price' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'type.required' => 'Le type de produit est obligatoire.',
            'price.required' => 'Le prix du produit est obligatoire.',
            'quantity.required' => 'La quantité est obligatoire.',
            'front_image.required' => 'L\'image de face est obligatoire.',
            'category_id.required' => 'La catégorie est obligatoire.',
            '*.image' => 'Le fichier doit être une image valide.',
            '*.mimes' => 'Seuls les formats jpeg, png, jpg et gif sont acceptés.',
            '*.max' => 'L\'image ne doit pas dépasser 2Mo.',
        ]);

        try {
            $product = new Product();
            $product->name = $validatedData['name'];
            $product->slug = Str::slug($validatedData['name']);
            $product->type = $validatedData['type'];
            $product->description = $validatedData['description'];
            $product->link = $validatedData['link'] ?? null;
            $product->price = $validatedData['price'];
            $product->prix_barre = $validatedData['prix_barre'] ?? 0;
            $product->quantity = $validatedData['quantity'];
            $product->category_id = $validatedData['category_id'];
            $product->is_active = true;

            // Gestion de l'image de face
            if ($request->hasFile('front_image')) {
                $frontPath = $this->optimizeAndStoreImage(
                    $request->file('front_image'),
                    'products',
                    Str::slug($validatedData['name']) . '-front-' . time()
                );
                $product->front_image = $frontPath;
            }

            // Gestion de l'image de l'arrière
            if ($request->hasFile('back_image')) {
                $backPath = $this->optimizeAndStoreImage(
                    $request->file('back_image'),
                    'products',
                    Str::slug($validatedData['name']) . '-back-' . time()
                );
                $product->back_image = $backPath;
            }

            $product->save();

            // Vérifier le statut après la création
            $product->updateStatusBasedOnStock();

            return redirect()->route('admin.products.list')->with('success', 'Produit ajouté avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout: ' . $e->getMessage());
        }
    }

    // Afficher le formulaire d'édition
    public function editproduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', 1)
                                ->orderBy('name', 'asc')
                                ->get();
        return view('admin.editproduct', compact('product', 'categories'));
    }

    // Mettre à jour un produit
    public function updateproduct(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:500',
            'price' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        try {
            $product->name = $validatedData['name'];
            $product->type = $validatedData['type'];
            $product->description = $validatedData['description'];
            $product->link = $validatedData['link'] ?? null;
            $product->price = $validatedData['price'];
            $product->prix_barre = $validatedData['prix_barre'] ?? 0;
            $product->quantity = $validatedData['quantity'];
            $product->category_id = $validatedData['category_id'];

            // Gestion de l'image de face
            if ($request->hasFile('front_image')) {
                // Supprime l'ancienne image
                if ($product->front_image) {
                    Storage::disk('public')->delete($product->front_image);
                }
                
                $frontPath = $this->optimizeAndStoreImage(
                    $request->file('front_image'),
                    'products',
                    Str::slug($validatedData['name']) . '-front-' . time()
                );
                $product->front_image = $frontPath;
            }

            // Gestion de l'image de l'arrière
            if ($request->hasFile('back_image')) {
                // Supprime l'ancienne image
                if ($product->back_image) {
                    Storage::disk('public')->delete($product->back_image);
                }
                
                $backPath = $this->optimizeAndStoreImage(
                    $request->file('back_image'),
                    'products',
                    Str::slug($validatedData['name']) . '-back-' . time()
                );
                $product->back_image = $backPath;
            }

            $product->save();

            // Vérifier le statut après la mise à jour
            $product->updateStatusBasedOnStock();

            return redirect()->route('admin.products.list')->with('success', 'Produit mis à jour avec succès!');
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
            $product->delete();

            return redirect()->route('admin.products.list')->with('success', 'Produit supprimé avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression: '.$e->getMessage());
        }
    }

    // Activer/Désactiver un produit
    public function toggleProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->is_active = !$product->is_active;
            $product->save();

            $message = $product->is_active ? 'Produit activé avec succès' : 'Produit désactivé avec succès';
            
            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la modification: '.$e->getMessage());
        }
    }

    // MÉTHODE PRIVÉE D'OPTIMISATION D'IMAGE
    private function optimizeAndStoreImage($image, $folder, $fileName)
    {
        $extension = 'webp';
        $fullFileName = $fileName . '.' . $extension;
        
        try {
            // NOUVELLE SYNTAXE Intervention Image v3.11.4
            $manager = new \Intervention\Image\ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );
            
            // Lire l'image depuis le fichier uploadé
            $img = $manager->read($image->getPathname());
            
            // Redimensionnement intelligent
            $size = ($folder === 'products') ? 1200 : 800;
            
            $img->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Conversion en WebP avec qualité optimale
            $optimizedImage = $img->toWebp(75);
            
            // Sauvegarde dans le storage public
            Storage::disk('public')->put($folder . '/' . $fullFileName, $optimizedImage);
            
            return $folder . '/' . $fullFileName;
            
        } catch (\Exception $e) {
            throw new \Exception("Erreur d'optimisation d'image: " . $e->getMessage());
        }
    }
}