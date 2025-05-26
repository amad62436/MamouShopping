@extends('clients.layout')

@section('title')
    Accueil
@endsection

@section('content')

    <div class="demo-hero-area bg-gray text-center section_padding_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Bigshop is a pleasingly graceful and stylish ecommerce template with a great user experience.</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Catagory Area -->
    <div class="shop_by_catagory_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading mb-50">
                        <h5><strong>Shop By Catagory</strong></h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="shop_by_catagory_slides owl-carousel">
                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/best-1.png" alt="">
                            </a>
                            <p>Sports Bra</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/best-2.png" alt="">
                            </a>
                            <p>Sunglasses</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/best-3.png" alt="">
                            </a>
                            <p>Watch</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/top-2.png" alt="">
                            </a>
                            <p>Hat</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/onsale-4.png" alt="">
                            </a>
                            <p>Bottle</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/onsale-5.png" alt="">
                            </a>
                            <p>Shoes</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/onsale-1.png" alt="">
                            </a>
                            <p>Speaker</p>
                        </div>

                        <!-- Single Slide -->
                        <div class="single_catagory_slide">
                            <a href="#">
                                <img src="clients/img/product-img/onsale-2.png" alt="">
                            </a>
                            <p>Lamp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Catagory Area -->

    <div class="demo-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mb-5">
                        <h4>New 3 Home Pages</h4>
                        <p>Creative, Modern &amp; Classic Demo</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Demo Area -->
                <div class="col-12 col-md-4">
                    <div class="single-demo-area mb-50">
                        <a href="{{url('/shop1')}}"><img src="clients/img/demo-img/h1.png" alt=""></a>
                        <a href="{{url('/shop1')}}" class="btn btn-primary btn-sm">Home One</a>
                    </div>
                </div>

                <!-- Single Demo Area -->
                <div class="col-12 col-md-4">
                    <div class="single-demo-area mb-50">
                        <a href="{{url('/shop2')}}"><img src="clients/img/demo-img/h2.png" alt=""></a>
                        <a href="{{url('/shop2')}}" class="btn btn-primary btn-sm">Home Two</a>
                    </div>
                </div>

                <!-- Single Demo Area -->
                <div class="col-12 col-md-4">
                    <div class="single-demo-area mb-50">
                        <a href="{{url('/shop3')}}"><img src="clients/img/demo-img/h3.png" alt=""></a>
                        <a href="{{url('/shop3')}}" class="btn btn-primary btn-sm">Home Three</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection  