@extends('clients.layout')

@section('title')
    Accueil
@endsection

@section('content')

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
                    <div class="col-6 col-md-3 col-lg-2 mb-4"> <!-- Ajustez les colonnes selon vos besoins -->
                        <div class="single_catagory_slide text-center">
                            <a href="{{ route('client.category.products', $category->slug) }}">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid">
                            </a>
                            <p class="mt-2">{{ $category->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Shop Catagory Area -->

@endsection