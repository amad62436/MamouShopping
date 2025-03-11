@extends('clients.layout')

@section('content')

    <!-- Welcome Slides Area -->
    <section class="welcome_area">
        <div class="welcome_slides modern-slides owl-carousel">
            <!-- Single Slide -->
            <div class="single_slide bg-img bg-overlay" style="background-image: url(clients/img/bg-img/1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text text-center">
                                <p class="text-white" data-animation="fadeInUp" data-delay="100ms">Trendy Fashion</p>
                                <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">Garments Apparels</h2>
                                <a href="#" class="btn btn-primary mt-4" data-animation="fadeInUp" data-delay="500ms">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide -->
            <div class="single_slide bg-img bg-overlay" style="background-image: url(clients/img/bg-img/2.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text text-center">
                                <p class="text-white" data-animation="fadeInUp" data-delay="100ms">Latest Trends</p>
                                <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">Exclusive Hat 2019</h2>
                                <a href="#" class="btn btn-primary mt-4" data-animation="fadeInUp" data-delay="500ms">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide -->
            <div class="single_slide bg-img bg-overlay" style="background-image: url(clients/img/bg-img/3.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text text-center">
                                <p class="text-white" data-animation="fadeInUp" data-delay="100ms">50% OFF</p>
                                <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">Kid's Collection</h2>
                                <a href="#" class="btn btn-primary mt-4" data-animation="fadeInUp" data-delay="500ms">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Slides Area -->

    

    <!-- Popular Items Area -->
    <div class="popular_items_area home-3 section_padding_0_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50 text-center">
                        <h5>Popular This Week</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="popular_items_slides owl-carousel">
                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-1.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-1-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span class="badge-offer">On Sale</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">City Bag</a></h5>
                                <h6>$18 <span>$24</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-2.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-2-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span class="badge-offer">Featured</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Wall Clock</a></h5>
                                <h6>$22 <span>$26</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-3.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-3-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span>Most Popular</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Pendant Light</a></h5>
                                <h6>$10 <span>$15</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-4.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-4-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span>25% Off</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">New Trend 2019</a></h5>
                                <h6>$30 <span>$32</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-1.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-1-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span class="badge-offer">On Sale</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Awesome Bag</a></h5>
                                <h6>$36 <span>$45</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-2.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-2-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span class="badge-offer">Featured</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Wall Clock</a></h5>
                                <h6>$78.99 <span>$98.87</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-3.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-3-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span>Most Popular</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Sinker Light</a></h5>
                                <h6>$9 <span>$12</span></h6>
                            </div>
                        </div>

                        <!-- Single Popular Item -->
                        <div class="single_popular_item">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="first_img" src="clients/img/product-img/popular-4.jpg" alt="">
                                <img class="hover_img" src="clients/img/product-img/popular-4-back.jpg" alt="">

                                <!-- Badge -->
                                <div class="product_badge">
                                    <span>25% Off</span>
                                </div>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                                </div>
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product_description">
                                <h5><a href="#">Trend 2019</a></h5>
                                <h6>$139.99 <span>$145.87</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popular Items Area -->

    

    <!-- New Arrivals Area -->
    <div class="new_arrival home-3 section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50 text-center">
                        <h5>New Arrivals</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-1.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-1-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Trendy Top's</a></h5>
                            <h6>$16 <span>$18</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-2.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-2-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Classy Black Dress</a></h5>
                            <h6>$32 <span>$36</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-3.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-3-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Purple Dress</a></h5>
                            <h6>$41 <span>$47</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-4.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-4-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Easy Wear</a></h5>
                            <h6>$160 <span>$180</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-5.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-5-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Men Fashion</a></h5>
                            <h6>$27 <span>$54</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-6.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-6-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Jara Fashion</a></h5>
                            <h6>$139 <span>$145</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-7.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-7-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Sports Wear</a></h5>
                            <h6>$285 <span>$310</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="clients/img/product-img/new-arrivals-8.jpg" alt="">
                            <img class="hover_img" src="clients/img/product-img/new-arrivals-8-back.jpg" alt="">
                            <!-- Wishlist -->
                            <div class="product_wishlist">
                                <a href="wishlist.html" target="_blank"><i class="icofont-heart"></i></a>
                            </div>
                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                <a href="#"><i class="icofont-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
                            <h5><a href="#">Men Fashion</a></h5>
                            <h6>$190 <span>$192</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Arrivals Area -->
    
@endsection  