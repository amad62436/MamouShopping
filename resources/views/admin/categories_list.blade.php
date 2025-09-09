@extends('admin.layout')

@php
    use Illuminate\Support\Facades\Session;
@endphp

@section('title')
    Liste des categories
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        {{-- End section header --}}

        {{-- Section form --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Toutes les categories</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.addcategory') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Ajouter une catégorie
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
                                            <th>Slug</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td>
                                                    @if($category->image)
                                                        <img src="{{ asset('storage/'.$category->image) }}" 
                                                             alt="{{ $category->name }}" 
                                                             width="60" 
                                                             style="border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">Aucune image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td class="text-center">
                                                    @if($category->is_active)
                                                        <span class="badge bg-success">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                                                    </form>
                                                    <form action="{{ route('admin.categories.toggle', $category->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        @if($category->is_active)
                                                            <button type="submit" class="btn btn-warning btn-sm">Désactiver</button>
                                                        @else
                                                            <button type="submit" class="btn btn-success btn-sm">Activer</button>
                                                        @endif
                                                    </form>
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
        {{-- End section form --}}
    </div>
@endsection