@extends('clients.layout')

@section('title')
    Accueil
@endsection

@section('content')

    @php
        use Illuminate\Support\Facades\Session;
        use Illuminate\Support\Str;
    @endphp

    <div class="demo-hero-area bg-gray text-center section_padding_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Bienvenue sur notre site de vente MamouShopping.</h2>
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
                        @if($product->quantity <= 5)
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