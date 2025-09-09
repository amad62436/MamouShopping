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
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Inscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Register Area -->
    <div class="bigshop_reg_log_area section_padding_50_50 d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login_form mb-50 p-4 bg-white shadow rounded">
                        <h5 class="mb-3 text-center">S'inscrire</h5>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Champ Full Name -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
    
                            <!-- Champ Email -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <!-- Champ Phone -->
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>

                            <!-- Champ Address -->
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                            </div>
    
                            <!-- Champ Password -->
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
    
                            <!-- Champ Password Confirmation -->
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
    
                            <!-- Bouton Register -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">S'inscrire</button>
                                <p class="mt-2 mb-0">Vous avez déjà un compte? <a href="{{ route('login') }}" class="btn btn-link btn-sm p-0">Se connecter</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Area End -->

@endsection