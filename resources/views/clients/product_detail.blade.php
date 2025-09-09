@extends('clients.layout')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>{{ $product->name }}</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('client.category.products', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <div class="container my-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- Image principale -->
                <div class="product-main-image mb-4">
                    <img src="{{ asset('storage/' . $product->front_image) }}" 
                         class="img-fluid rounded" 
                         alt="{{ $product->name }}"
                         style="max-height: 250px; width: 100%; object-fit: cover;">
                </div>

                <!-- Image arrière (si elle existe) -->
                @if($product->back_image)
                    <div class="product-back-image">
                        <img src="{{ asset('storage/' . $product->back_image) }}" 
                             class="img-fluid rounded" 
                             alt="Arrière de {{ $product->name }}"
                             style="max-height: 250px; width: 100%; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-6">
                <div class="product-details">
                    <h2 class="product-title">{{ $product->name }}</h2>
                    
                    <div class="product-category mb-2">
                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    </div>

                    <div class="product-price mb-3">
                        <h3 class="text-primary">{{ number_format($product->price, 0, ',', ' ') }} FG</h3>
                        @if($product->prix_barre && $product->prix_barre > $product->price)
                            <del class="text-muted">{{ number_format($product->prix_barre, 0, ',', ' ') }} FG</del>
                        @endif
                    </div>

                    <div class="product-stock mb-3">
                        @if($product->quantity > 0)
                            <span class="text-success">✓ En stock ({{ $product->quantity }} disponible(s))</span>
                        @else
                            <span class="text-danger">✗ Rupture de stock</span>
                        @endif
                    </div>

                    <div class="product-description mb-4">
                        <h5>Description</h5>
                        <p>{{ $product->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    @if($product->link)
                        <div class="product-link mb-3">
                            <a href="{{ $product->link }}" target="_blank" class="btn btn-info">
                                <i class="fas fa-external-link-alt"></i> Voir la vidéo du produit
                            </a>
                        </div>
                    @endif

                    <!-- Formulaire d'ajout au panier -->
                    @if($product->quantity > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="quantity" class="form-label">Quantité</label>
                                    <input type="number" 
                                           name="quantity" 
                                           id="quantity" 
                                           class="form-control" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->quantity }}"
                                           required>
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="btn btn-primary w-70 mt-4">
                                        <i class="fas fa-cart-plus"></i> Ajouter au panier
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <button class="btn btn-secondary" disabled>
                            Produit indisponible
                        </button>
                    @endif

                    <div class="product-actions mt-5">
                        <a href="{{ route('client.home') }}" class="btn btn-primary w-50 mt-4">
                            <i class="fas fa-arrow-left"></i> Continuer mes achats
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection