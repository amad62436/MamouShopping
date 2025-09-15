@extends('clients.layout')

@section('title')
    Panier
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Votre <strong>Panier</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Area -->
    <section class="cart-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(empty($cart))
                        <div class="text-center">
                            <p>Votre panier est vide.</p>
                            <a href="{{ url('/') }}" class="btn btn-primary">Ajouter des produits</a>
                        </div>
                    @else
                        <div class="cart-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="cart-item-desc">
                                                <a href="{{ route('client.product.detail', $item['id']) }}" class="image">
                                                    <img src="{{ asset('storage/' . $item['front_image']) }}" 
                                                         class="cart-thumb" 
                                                         alt="{{ $item['name'] }}"
                                                         loading="lazy"
                                                         width="60"
                                                         height="60">
                                                </a>
                                                <div>
                                                    <a href="{{ route('client.product.detail', $item['id']) }}">{{ $item['name'] }}</a>
                                                    <p class="text-muted small">Stock disponible: {{ $item['max_quantity'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item['price'], 0, ',', ' ') }} FG</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" max="{{ $item['max_quantity'] }}" 
                                                       onchange="this.form.submit()" style="width: 60px;">
                                            </form>
                                        </td>
                                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FG</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="icofont-bin"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-total-area mt-5">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="cart-pricing">
                                        <h5>Total du panier</h5>
                                        <ul>
                                            <li>
                                                <span>Sous-total:</span>
                                                <span>{{ number_format($total, 0, ',', ' ') }} FG</span>
                                            </li>
                                            <li>
                                                <span>Livraison:</span>
                                                <span>Gratuite</span>
                                            </li>
                                            <li class="total">
                                                <span>Total:</span>
                                                <span>{{ number_format($total, 0, ',', ' ') }} FG</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="{{ url('/') }}" class="btn btn-primary w-100">Ajouter</a>
                                        </div>
                                        <div class="col-4">
                                            @auth
                                                <a href="{{ route('orders.checkout') }}" class="btn btn-success w-100">Commander</a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-warning w-100">Se connecter</a>
                                            @endauth
                                        </div>
                                        <div class="col-4">
                                            <form action="{{ route('cart.clear') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">Vider</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection