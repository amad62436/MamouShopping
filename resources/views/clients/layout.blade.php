<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title  -->
        <title>@yield('title')</title>

        <!-- Favicon  -->
        <link rel="icon" href="{{asset('clients/img/core-img/favicon.ico')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset('clients/style.css')}}">

    </head>

    <body>
        
        <!-- Preloader -->
        <div id="preloader">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Header Area -->
        <header class="header_area">
            <!-- Main Menu -->
            <div class="bigshop-main-menu">
                <div class="container">
                    <div class="classy-nav-container breakpoint-off">
                        <nav class="classy-navbar" id="bigshopNav">

                            <!-- Nav Brand -->
                            <a href="{{ url('/') }}" class="nav-brand"><img src="{{ asset('clients/img/core-img/logo.png') }}" alt="logo" loading="lazy" width="120" height="40"></a>

                            <!-- Toggler -->
                            <div class="classy-navbar-toggler">
                                <span class="navbarToggler"><span></span><span></span><span></span></span>
                            </div>

                            <!-- Menu -->
                            <div class="classy-menu">
                                <!-- Close -->
                                <div class="classycloseIcon">
                                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                </div>

                                <!-- Nav -->
                                <div class="classynav">
                                    <ul>
                                        <!-- Accueil -->
                                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                            <a href="{{ url('/') }}" class="nav-link">
                                                <strong>Accueil</strong>
                                            </a>
                                        </li>
                                
                                        <!-- Outils Numériques -->
                                        <li class="nav-item {{ request()->is('shop1') ? 'active' : '' }}">
                                            <a href="{{ url('/shop1') }}" class="nav-link">
                                                <strong>Outils Numériques</strong>
                                            </a>
                                        </li>
                                
                                        <!-- Produits Cosmotiques -->
                                        <li class="nav-item {{ request()->is('shop2') ? 'active' : '' }}">
                                            <a href="{{ url('/shop2') }}" class="nav-link">
                                                <strong>Produits Cosmotiques</strong>
                                            </a>
                                        </li>
                                
                                        <!-- Autres Produits -->
                                        <li class="nav-item {{ request()->is('shop3') ? 'active' : '' }}">
                                            <a href="{{ url('/shop3') }}" class="nav-link">
                                                <strong>Autres Produits</strong>
                                            </a>
                                        </li>
                                
                                        <!-- Contact -->
                                        {{-- <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                                            <a href="{{ url('/contact') }}" class="nav-link">
                                                <strong>Contact</strong>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                            <!-- Hero Meta -->
                            <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">

                                <!-- Barre de recherche -->
                                <div class="search-area mr-3">
                                    <form action="{{ route('client.search') }}" method="GET" class="d-flex">
                                        <input type="text" name="query" class="form-control form-control-sm" 
                                            placeholder="Rechercher..." required style="width: 100px;">
                                        <button class="btn btn-primary btn-sm ml-1" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Cart -->
                                <div class="cart-area">
                                    @php
                                        use Illuminate\Support\Facades\Session;
                                        use Illuminate\Support\Str;
                                        use Illuminate\Support\Facades\Auth;
                                        $cart = Session::get('cart', []);
                                        $cartCount = array_sum(array_column($cart, 'quantity'));
                                        $subTotal = 0;
                                        foreach ($cart as $item) {
                                            $subTotal += $item['price'] * $item['quantity'];
                                        }
                                        $shipping = 0;
                                        $total = $subTotal + $shipping;
                                    @endphp

                                    <div class="cart--btn">
                                        <i class="icofont-cart"></i> 
                                        <span class="cart_quantity">{{ $cartCount }}</span>
                                    </div>

                                    <!-- Cart Dropdown Content -->
                                    <div class="cart-dropdown-content">
                                        @if(empty($cart))
                                            <div class="p-3 text-center">
                                                <p>Votre panier est vide</p>
                                            </div>
                                        @else
                                            <ul class="cart-list">
                                                @foreach($cart as $item)
                                                    <li>
                                                        <div class="cart-item-desc">
                                                            <a href="{{ route('client.product.detail', $item['id']) }}" class="image">
                                                                <img src="{{ asset('storage/' . $item['front_image']) }}" class="cart-thumb" alt="{{ $item['name'] }}" loading="lazy" width="60" height="60">
                                                            </a>
                                                            <div>
                                                                <a href="{{ route('client.product.detail', $item['id']) }}">{{ $item['name'] }}</a>
                                                                <p>{{ $item['quantity'] }} x - <span class="price">{{ number_format($item['price'], 0, ',', ' ') }} FG</span></p>
                                                            </div>
                                                        </div>
                                                        <span class="dropdown-product-remove">
                                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                                                    <i class="icofont-bin"></i>
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                    
                                            <div class="cart-pricing my-4">
                                                <ul>
                                                    <li>
                                                        <span>Sous-total:</span>
                                                        <span>{{ number_format($subTotal, 0, ',', ' ') }} FG</span>
                                                    </li>
                                                    <li>
                                                        <span>Livraison:</span>
                                                        <span>Gratuite</span>
                                                    </li>
                                                    <li>
                                                        <span>Total:</span>
                                                        <span>{{ number_format($total, 0, ',', ' ') }} FG</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
            
                                        <div class="cart-box">
                                            <a href="{{ route('cart.index') }}" class="btn btn-primary d-block">Voir le panier</a>
                                            @if(!empty($cart))
                                                <form action="{{ route('cart.clear') }}" method="POST" class="mt-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm d-block w-100">Vider le panier</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Account -->
                                <div class="account-area">
                                    @auth
                                        <!-- Utilisateur connecté -->
                                        <div class="user-thumbnail">
                                            <img src="{{ asset('clients/img/bg-img/user.jpg') }}" alt="Utilisateur" loading="lazy" width="40" height="40">
                                        </div>
                                        <ul class="user-meta-dropdown">
                                            <li class="user-title"><span>Salut,</span> {{ Auth::user()->name }}</li>
                                            <li><a href="{{ route('client.account') }}">Mon Compte</a></li>
                                            <li><a href="{{ route('orders.history') }}">Mes Commandes</a></li>
                                            
                                            <!-- Bouton Admin seulement pour les administrateurs -->
                                            @if(Auth::user()->role === 'admin')
                                                <li><a href="{{ route('admin.dashboard') }}" class="text-danger"><i class="fas fa-cog"></i> Administration</a></li>
                                            @endif
                                            
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="icofont-logout"></i> Déconnexion
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    @else
                                        <!-- Utilisateur non connecté -->
                                        <div class="user-thumbnail">
                                            <img src="{{ asset('clients/img/bg-img/user.jpg') }}" alt="Utilisateur" loading="lazy" width="40" height="40">
                                        </div>
                                        <ul class="user-meta-dropdown">
                                            <li class="user-title"><span>Salut,</span> Visiteur</li>
                                            <li><a href="{{ route('login') }}">Se connecter</a></li>
                                            <li><a href="{{ route('register') }}">Créer un compte</a></li>
                                        </ul>
                                    @endauth
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Area end -->


        {{-- Start Client --}}

        @yield('content')
            {{-- Message de succès --}}
            @if (Session::has("success"))
                <div class="alert alert-success">
                    {{Session::get("success")}}
                </div>
            @endif
        {{-- End Client --}}


        <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Livraison Gratuite -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-delivery-time"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Livraison Gratuite</h6>
                            <p>Dans toute la ville de Mamou de <b>08h00 - 18h00</b></p>
                        </div>
                    </div>
                </div>

                <!-- Garantie Produit -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Garantie Produit</h6>
                            <p><b>48h</b> après livraison</p>
                        </div>
                    </div>
                </div>

                <!-- Paiement Sécurisé -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Paiement Sécurisé</h6>
                            <p>Orange Money & Mobile Money</p>
                        </div>
                    </div>
                </div>

                <!-- Support Client -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Support 7j/7 08-22h</h6>
                            <p>WhatsApp & Appels directs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->

        <!-- Footer Area -->
        <footer class="footer_area section_padding_100_0">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Area -->
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                        <div class="single_footer_area mb-100">
                            <div class="footer_heading mb-4">
                                <h4 class="text-white">Contactez-nous</h4>
                            </div>
                            <ul class="footer_content">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Conserverie, Mamou, Guinée
                                </li>
                                <li>
                                    <i class="fas fa-phone"></i>  
                                    <a href="tel:+224621304708" class="text-white">+224 621 30 47 08</a>
                                </li>
                                 <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel:+224663700422" class="text-white">+224 663 70 04 22</a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i> 
                                    <a href="mailto:mamoushopping@gmail.com" class="text-white">mamoushopping@gmail.com</a>
                                </li>
                                <li>
                                    <i class="fab fa-whatsapp"></i>
                                    <a href="https://wa.me/224621304708" target="_blank" class="text-white">+224 621 30 47 08</a>
                                </li>
                            </ul>
                            <div class="footer_social_area mt-50">
                                <h6 class="text-white">Nous suivre sur :</h6>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/amadoumouctar10/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://www.tiktok.com/@amdprocedure" target="_blank"><i class="fa fa-tiktok" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>
        <!-- Footer Area -->

        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="{{asset('clients/js/jquery.min.js')}}"></script>
        <script src="{{asset('clients/js/popper.min.js')}}"></script>
        <script src="{{asset('clients/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery.easing.min.js')}}"></script>
        <script src="{{asset('clients/js/default/classy-nav.min.js')}}"></script>
        <script src="{{asset('clients/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('clients/js/default/scrollup.js')}}"></script>
        <script src="{{asset('clients/js/waypoints.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery.countdown.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('clients/js/jarallax.min.js')}}"></script>
        <script src="{{asset('clients/js/jarallax-video.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('clients/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{asset('clients/js/wow.min.js')}}"></script>
        <script src="{{asset('clients/js/default/active.js')}}"></script>

    </body>
</html>