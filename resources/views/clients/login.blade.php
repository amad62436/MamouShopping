@extends('clients.layout')

@section('title')
    Connexion
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Formulaire de connexion</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Connexion</li>
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
                        <h5 class="mb-3 text-center">Se connecter</h5> <!-- Titre centré -->
                        <form action="https://designing-world.com/bigshop-2.3.0/my-account.html" method="post">
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
                            
                            <!-- Bouton Register et texte avec bouton Login -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Register</button>
                                <p class="mt-2 mb-0">Vous n'avez pas de compte? <a href="#" class="btn btn-link btn-sm p-0">creer son compte</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End -->

@endsection  