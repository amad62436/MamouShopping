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
                            <a href="index.html" class="nav-brand"><img src="clients/img/core-img/logo.png" alt="logo"></a>

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
                                        <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                                            <a href="{{ url('/contact') }}" class="nav-link">
                                                <strong>Contact</strong>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Hero Meta -->
                            <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">

                                <!-- Cart -->
                                <div class="cart-area">
                                    <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity">2</span></div>

                                    <!-- Cart Dropdown Content -->
                                    <div class="cart-dropdown-content">
                                        <ul class="cart-list">
                                            <li>
                                                <div class="cart-item-desc">
                                                    <a href="#" class="image">
                                                        <img src="clients/img/product-img/top-1.png" class="cart-thumb" alt="">
                                                    </a>
                                                    <div>
                                                        <a href="#">Kid's Fashion</a>
                                                        <p>1 x - <span class="price">$32.99</span></p>
                                                    </div>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icofont-bin"></i></span>
                                            </li>
                                            <li>
                                                <div class="cart-item-desc">
                                                    <a href="#" class="image">
                                                        <img src="clients/img/product-img/best-4.png" class="cart-thumb" alt="">
                                                    </a>
                                                    <div>
                                                        <a href="#">Headphone</a>
                                                        <p>2x - <span class="price">$49.99</span></p>
                                                    </div>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icofont-bin"></i></span>
                                            </li>
                                        </ul>
                                        <div class="cart-pricing my-4">
                                            <ul>
                                                <li>
                                                    <span>Sub Total:</span>
                                                    <span>$822.96</span>
                                                </li>
                                                <li>
                                                    <span>Shipping:</span>
                                                    <span>$30.00</span>
                                                </li>
                                                <li>
                                                    <span>Total:</span>
                                                    <span>$856.63</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="cart-box">
                                            <a href="{{url('/cart')}}" class="btn btn-primary d-block">Voir le panier</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Account -->
                                <div class="account-area">
                                    <div class="user-thumbnail">
                                        <img src="clients/img/bg-img/user.jpg" alt="">
                                    </div>
                                    <ul class="user-meta-dropdown">
                                        <li class="user-title"><span>Hello,</span> Lim Sarah</li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="order-list.html">Orders List</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="login.html"><i class="icofont-logout"></i> Logout</a></li>
                                    </ul>
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

        {{-- End Client --}}


        <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-delivery-time"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
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
                                <h6>Contact Us</h6>
                            </div>
                            <ul class="footer_content">
                                <li><span>Address:</span> Lords, London, UK - 1259</li>
                                <li><span>Phone:</span> 002 63695 24624</li>
                                <li><span>FAX:</span> 002 78965 369552</li>
                                <li><span>Email:</span> support@example.com</li>
                            </ul>
                            <div class="footer_social_area mt-50">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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