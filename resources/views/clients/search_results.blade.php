@extends('clients.layout')

@section('title')
    Résultats de recherche
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Résultats de recherche</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Recherche</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Résultats pour "{{ $query }}"</h2>
                
                @if($products->isEmpty())
                    <div class="alert alert-info">
                        <p>Aucun produit trouvé pour votre recherche.</p>
                        <a href="{{ route('client.home') }}" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                @else
                    <p class="mb-4">{{ $products->count() }} produit(s) trouvé(s)</p>
                    
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card product-card h-100">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/' . $product->front_image) }}" 
                                             class="card-img-top" 
                                             alt="{{ $product->name }}"
                                             style="height: 200px">

                                        @if($product->quantity == 0)
                                            <div class="product-badge out-of-stock">
                                                <span>Rupture de stock</span>
                                            </div>
                                        @elseif($product->quantity < 3)
                                            <div class="product-badge low-stock">
                                                <span>Stock faible</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">
                                            <strong class="text-primary">
                                                {{ number_format($product->price, 0, ',', ' ') }} FG
                                            </strong>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('client.product.detail', $product->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                Voir détails
                                            </a>
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection