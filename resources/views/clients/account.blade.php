@extends('clients.layout')

@section('title')
    Mon Compte
@endsection

@section('content')
    
     <!-- Breadcumb Area -->
     <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Mon Compte</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Mon Compte</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <a href="{{ route('client.account') }}" class="list-group-item list-group-item-action active">Mon Profil</a>
                    <a href="{{ route('orders.history') }}" class="list-group-item list-group-item-action">Mes Commandes</a>
                    <a href="{{ route('client.wishlist') }}" class="list-group-item list-group-item-action">Wishlist</a>
                    <a href="{{ route('client.account.edit') }}" class="list-group-item list-group-item-action">Modifier mon profil</a>
                    <a href="{{ route('client.password.edit') }}" class="list-group-item list-group-item-action">Changer mon mot de passe</a>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action text-danger">
                            <i class="fas fa-cog"></i> Administration
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Informations personnelles</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p><strong>Nom:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Téléphone:</strong> {{ $user->phone ?? 'Non renseigné' }}</p>
                        <p><strong>Adresse:</strong> {{ $user->address ?? 'Non renseignée' }}</p>
                        <p><strong>Rôle:</strong> 
                            <span class="badge {{ $user->role === 'admin' ? 'badge-danger' : 'badge-primary' }}">
                                {{ $user->role === 'admin' ? 'Administrateur' : 'Client' }}
                            </span>
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('client.account.edit') }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i> Modifier mon profil
                            </a>
                            <a href="{{ route('client.password.edit') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-lock me-1"></i> Changer mon mot de passe
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection