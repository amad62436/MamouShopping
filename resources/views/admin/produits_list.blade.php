@extends('admin.layout')

@php
    use Illuminate\Support\Facades\Session;
@endphp

@section('title')
    Liste des produits
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produits</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Produits</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section form --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tous les produits</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.addproduct') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Ajouter un produit
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- Message de succès --}}
                                @if (Session::has("success"))
                                    <div class="alert alert-success">
                                        {{Session::get("success")}}
                                    </div>
                                @endif

                                <table id="example1" class="table table-bordered table-striped">
                                    <input type="hidden" {{$increment = 1}}>
                                    <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Image</th>
                                            <th>Nom</th>
                                            <th>Prix</th>
                                            <th>Prix barré</th>
                                            <th>Quantité</th>
                                            <th>Catégorie</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td>
                                                    <img src="{{ asset('storage/'.$product->front_image) }}" 
                                                         alt="{{ $product->name }}"    
                                                         width="60"
                                                         style="border-radius: 4px;">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ number_format($product->price, 0, ',', ' ') }} FGN</td>
                                                <td>
                                                    @if($product->prix_barre)
                                                        {{ number_format($product->prix_barre, 0, ',', ' ') }} FGN
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td class="text-center">
                                                    @if($product->is_active)
                                                        <span class="badge bg-success">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        @if ($product->is_active == 1)
                                                            <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn-sm" title="Désactiver">
                                                                    <i class="fas fa-toggle-on"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-warning btn-sm" title="Activer">
                                                                    <i class="fas fa-toggle-off"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm" title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <input type="hidden" {{$increment++}}>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection