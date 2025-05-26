@extends('clients.layout')

@section('title')
    Inscription
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Formulaire d'inscription</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Inscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- register Area -->
    <div class="bigshop_reg_log_area section_padding_100_50 d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center"> <!-- Centrer la ligne -->
                <div class="col-12 col-md-6"> <!-- Largeur de la colonne -->
                    <div class="login_form mb-50 p-4 bg-white shadow rounded">
                        <h5 class="mb-3 text-center">S'inscrire</h5> <!-- Titre centré -->
                        <form action="https://designing-world.com/bigshop-2.3.0/my-account.html" method="post">
                            <!-- Champ Full Name -->
                            <div class="form-group mb-3"> <!-- Réduction de la marge bottom -->
                                <label for="username" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter your full name">
                            </div>
    
                            <!-- Champ Email -->
                            <div class="form-group mb-3"> <!-- Réduction de la marge bottom -->
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
    
                            <!-- Champ Password -->
                            <div class="form-group mb-3"> <!-- Réduction de la marge bottom -->
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter your password">
                            </div>
    
                            <!-- Champ Repeat Password -->
                            <div class="form-group mb-3"> <!-- Réduction de la marge bottom -->
                                <label for="repeatPassword" class="form-label">Repeat Password</label>
                                <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat your password">
                            </div>
    
                            <!-- Bouton Register et texte avec bouton Login -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Register</button>
                                <p class="mt-2 mb-0">Vous avez déjà un compte? <a href="#" class="btn btn-link btn-sm p-0">Se connecter</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End -->

@endsection  