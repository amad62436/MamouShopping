<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(){
        return view('admin.home');
    }

    //Gestions des categories

    // Afficher le formulaire de création des categories
    public function addcategory(){
        return view('admin.addcategory');
    }

    // Afficher la liste des catégories
    public function categories_list(){
        $categories = Category::all();
        return view('admin.categories_list', compact('categories'));
    }


    //Gestions des Produits

    // Afficher le formulaire de création des produits
    public function addproduct(){
        $categories = Category::all(); // Récupère toutes les catégories
        return view('admin.addproduct', compact('categories'));
    }

    // Afficher la liste des produits
    public function produits_list()
    {
        $products = Product::with('category')->get();
        return view('admin.produits_list', compact('products'));
    }
}