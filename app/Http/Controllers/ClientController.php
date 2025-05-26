<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home(){
        return view('clients.home');
    }

    public function shop1(){
        return view('clients.shop1');
    }

    public function shop2(){
        return view('clients.shop2');
    }

    public function shop3(){
        return view('clients.shop3');
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
}
