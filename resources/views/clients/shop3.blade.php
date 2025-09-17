@extends('clients.layout')

@section('title')
    Autres Produits
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Produits de type : <strong>Autre</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Selling Products -->
    <section class="best-selling-products-area mb-70 section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading mb-50">
                        <h5><strong>{{ $products->count() }} Produit(s) disponible(s)</strong></h5>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach($products as $product)
                <!-- Single Product -->
                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single-product-area mb-30">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="normal_img" src="{{ asset('storage/' . $product->front_image) }}" 
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 width="300"
                                 height="300">

                            <!-- Product Badge -->
                            <div class="product_badge">
                                <span>Top</span>
                            </div>
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

                        <!-- Product Description -->
                        <div class="product_description">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Add to cart -->
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="me-2">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="product_add_to_cart" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        <i class="icofont-cart"></i> Ajouter au panier
                                    </button>
                                </form>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview-{{ $product->id }}" style="text-decoration: none;">
                                        <i class="icofont-eye-alt"></i> Détail
                                    </a>
                                </div>
                            </div>

                            <a href="#">{{ $product->name }}</a>
                            <h6 class="product-price">{{ number_format($product->price, 0, ',', ' ') }} FG</h6>
                        </div>
                    </div>
                </div>

                <!-- Quick View Modal Area for each product -->
                <div class="modal fade" id="quickview-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="quickview-{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body">
                                <div class="quickview_body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-lg-5">
                                                <div class="quickview_pro_img">
                                                    <img class="first_img" 
                                                         src="{{ $product->back_image ? asset('storage/' . $product->back_image) : asset('storage/' . $product->front_image) }}" 
                                                         alt="{{ $product->name }}"
                                                         loading="lazy"
                                                         width="400"
                                                         height="400">
                                                    <img class="hover_img" 
                                                         src="{{ asset('storage/' . $product->front_image) }}" 
                                                         alt="{{ $product->name }}"
                                                         loading="lazy"
                                                         width="400"
                                                         height="400">
                                                    <!-- Product Badge -->
                                                    <div class="product_badge">
                                                        <span class="badge-new">Nouveau!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-7">
                                                <div class="quickview_pro_des">
                                                    <h4 class="title">{{ $product->name }}</h4>
                                                    <h5 class="price">{{ number_format($product->price, 0, ',', ' ') }} FG
                                                        @if($product->prix_barre && $product->prix_barre > $product->price)
                                                            <span>{{ number_format($product->prix_barre, 0, ',', ' ') }} FG</span>
                                                        @endif
                                                    </h5>
                                                    <p><strong>Description:</strong> {{ $product->description ?? 'Description non disponible' }}</p>
                                                    <p><strong>Quantité disponible:</strong> {{ $product->quantity }} unité(s)</p>
                                                    @if($product->link)
                                                        <div class="mt-3">
                                                            <a href="{{ $product->link }}" target="_blank">
                                                                <i class="fab fa-facebook"></i> Voir la vidéo du produit
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- Add to Cart Form -->
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart">
                                                    @csrf
                                                    <div class="quantity">
                                                        <span class="qty-text">Quantité:</span>
                                                        <input type="number" class="qty-text" id="qty-{{ $product->id }}" 
                                                               step="1" min="1" max="{{ $product->quantity }}" 
                                                               name="quantity" value="1">
                                                        <small>Max: {{ $product->quantity }}</small>
                                                    </div>
                                                    <button type="submit" class="cart-submit">Ajouter au panier</button>
                                                </form>
                                                <!-- Share -->
                                                <div class="share_wf mt-30">
                                                    <p>Nous suivre sur : </p>
                                                    <div class="_icon">
                                                        <a href="https://www.facebook.com/profile.php?id=61581077248843" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                        <a href="https://www.instagram.com/amadoumouctar10/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                                        <a href="https://www.tiktok.com/@amdprocedure" target="_blank"><i class="fa fa-tiktok" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Quick View Modal Area -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- Best Selling Products -->

@endsection