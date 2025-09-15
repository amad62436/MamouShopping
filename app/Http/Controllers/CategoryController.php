<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    // Afficher la liste des catégories - OPTIMISÉ
    public function index()
    {
        $categories = Category::select('id', 'name', 'image', 'is_active', 'created_at')
                            ->orderBy('name')
                            ->get();

        return view('admin.categories_list', compact('categories'));
    }

    // Afficher le formulaire de création - OPTIMISÉ
    public function create()
    {
        return view('admin.addcategory');
    }

    // Enregistrer une nouvelle catégorie - OPTIMISÉ
    public function savecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'image.required' => 'L\'image de la catégorie est obligatoire.',
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->is_active = true;
            
            // Gestion de l'image
            if ($request->hasFile('image')) {
                $imagePath = $this->optimizeAndStoreImage(
                    $request->file('image'),
                    'categories',
                    Str::slug($request->name) . '-' . time()
                );
                $category->image = $imagePath;
            }

            $category->save();

            // Clear cache après modification
            Cache::forget('home_categories');
            Cache::forget('active_categories');

            return redirect()->route('admin.categories.list')->with('success', 'Catégorie créée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Afficher le formulaire d'édition - OPTIMISÉ
    public function editcategory($id)
    {
        $category = Category::select('id', 'name', 'image')->findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    // Mettre à jour une catégorie - OPTIMISÉ
    public function updatecategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);

            // Gestion de l'image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                
                $imagePath = $this->optimizeAndStoreImage(
                    $request->file('image'),
                    'categories',
                    Str::slug($request->name) . '-' . time()
                );
                $category->image = $imagePath;
            }

            $category->save();

            // Clear cache après modification
            Cache::forget('home_categories');
            Cache::forget('active_categories');

            return redirect()->route('admin.categories.list')->with('success', 'Catégorie mise à jour avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer une catégorie - OPTIMISÉ
    public function deletecategory($id)
    {
        try {
            $category = Category::select('id', 'image')->findOrFail($id);
            
            // Supprimer l'image associée
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            
            $category->delete();
            
            // Clear cache après suppression
            Cache::forget('home_categories');
            Cache::forget('active_categories');
            
            return back()->with('success', 'Catégorie supprimée avec succès.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Activer/Désactiver une catégorie - OPTIMISÉ
    public function toggleCategory($id)
    {
        try {
            $category = Category::select('id', 'is_active')->findOrFail($id);
            $category->is_active = !$category->is_active;
            $category->save();

            // Clear cache après modification
            Cache::forget('home_categories');
            Cache::forget('active_categories');

            $message = $category->is_active ? 'Catégorie activée avec succès' : 'Catégorie désactivée avec succès';
            
            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // MÉTHODE PRIVÉE D'OPTIMISATION D'IMAGE - OPTIMISÉE
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
            $size = ($folder === 'products') ? 800 : 600;
            
            $img->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Conversion en WebP
            $optimizedImage = $img->toWebp(80);
            
            // Sauvegarde dans le storage public
            Storage::disk('public')->put($folder . '/' . $fullFileName, $optimizedImage);
            
            return $folder . '/' . $fullFileName;
            
        } catch (\Exception $e) {
            throw new \Exception("Erreur d'optimisation d'image: " . $e->getMessage());
        }
    }
}