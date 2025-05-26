<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Enregistrer une nouvelle catégorie
    public function savecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.max' => 'Le nom de la catégorie ne doit pas dépasser 255 caractères.',
        ]);

        Category::create($request->all());

        return redirect('/admin/categories_list')->with('status', 'Catégorie créée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function editcategory($id)
    {
        $category = Category::find($id);
        return view('admin.editcategory', compact('category'));
    }

    // Mettre à jour une catégorie
    public function updatecategory(Request $request, $id)
    {

        $category = Category::find($id);
        
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.max' => 'Le nom de la catégorie ne doit pas dépasser 255 caractères.',
        ]);

        $category->update($request->all());

        return redirect('/admin/categories_list')->with('status', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer une catégorie
    public function deletecategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('status', 'Catégorie supprimée avec succès.');
    }
}