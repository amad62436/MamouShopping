@extends('clients.layout')

@section('title')
    Wishlist
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Ma Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <h4>Fonctionnalité en développement</h4>
                    <p>La wishlist sera bientôt disponible. Revenez plus tard !</p>
                </div>
            </div>
        </div>
    </div>

@endsection