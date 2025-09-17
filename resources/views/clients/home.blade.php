@extends('clients.layout')

@section('title')
    Accueil
@endsection

@section('content')

    @php
        use Illuminate\Support\Facades\Session;
        use Illuminate\Support\Str;
    @endphp

    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Bienvenue chez <strong>MamouShopping</strong></h2>
                    
                    <p class="text-muted mb-3">
                        Nous vous offrons des produits de haute qualité et de bonne qualité. 
                        Votre boutique en ligne de confiance à Mamou. Découvrez un large choix de produits 
                        soigneusement sélectionnés pour vous offrir la meilleure qualité au meilleur prix.
                    </p>
                    
                    <div class="highlight-box p-3 mb-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #28a745;">
                        <h5 class="text-success mb-2">🚚 Livraison Gratuite !</h5>
                        <p class="mb-0">
                            <strong>Livraison GRATUITE</strong> dans toute la ville de Mamou ! 
                            <br>Livraison disponible partout en Guinée aux frais du client.
                        </p>
                    </div>
                    
                    <p class="mb-3">
                        ✅ <strong>Paiement sécurisé</strong> Orange Money & Mobile Money<br>
                        ✅ <strong>Support 7j/7</strong> de 8h à 22h<br>
                        ✅ <strong>Garantie</strong> sur tous nos produits
                    </p>
                    
                    <p class="text-muted mb-0">
                        Avec <strong>MamouShopping</strong>, vos achats sont simples, rapides et sécurisés. 
                        Faites-vous plaisir dès aujourd'hui, et profitez d'une expérience de shopping unique !
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Catagory Area -->
    <div class="shop_by_catagory_area section_padding_80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading mb-50">
                        <h5><strong>Categories disponibles</strong></h5>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($categories as $category)
                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                        <div class="single_catagory_slide text-center">
                            <a href="{{ route('client.category.products', $category->slug) }}">
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="img-fluid"
                                     loading="lazy"
                                     width="120"
                                     height="120">
                            </a>
                            <p class="mt-2">{{ $category->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products Area -->
    @if($products->count() > 0)
    <div class="featured-products-area section_padding_80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading mb-50">
                        <h5><strong>Produits Populaires</strong></h5>
                    </div>
                </div>
            </div>
            
                <div class="row">
                    @foreach($products as $product)
                        @if($product->quantity <= 3)
                            <div class="col-6 col-md-3 mb-4">
                                <div class="card product-card">
                                    <a href="{{ route('client.product.detail', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->front_image) }}" 
                                            alt="{{ $product->name }}"
                                            class="card-img-top"
                                            loading="lazy"
                                            width="300"
                                            height="300">
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title">{{ Str::limit($product->name, 50) }}</h6>
                                        <p class="price">{{ number_format($product->price, 0, ',', ' ') }} FG</p>
                                        
                                        <!-- Affichage du stock -->
                                        @if($product->quantity > 0)
                                            <span class="badge badge-success">En stock ({{ $product->quantity }})</span>
                                        @else
                                            <span class="badge badge-danger">Rupture de stock</span>
                                        @endif
                                        
                                        <a href="{{ route('client.product.detail', $product->id) }}" class="btn btn-primary btn-sm mt-2">Voir détails</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    

@endsection