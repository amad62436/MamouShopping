@extends('admin.layout')

@section('title')
    Modifier un produit
@endsection

@section('content')  
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier un Produit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.list') }}">Produits</a></li>
                            <li class="breadcrumb-item active">Modifier</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Modifier le produit</h3>
                            </div>
                            
                            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                                <div class="card-body">
                                    @csrf
                                    @method('PUT')
                                    
                                    {{-- Messages d'alerte --}}
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="icon fas fa-check"></i> {{ session('success') }}
                                        </div>
                                    @endif
                                    
                                    @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="icon fas fa-ban"></i> {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nom *</label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="type">Type *</label>
                                                <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $product->type) }}" required>
                                                @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id">Catégorie *</label>
                                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="price">Prix (FGN) *</label>
                                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="prix_barre">Prix barré (FGN)</label>
                                                        <input type="number" name="prix_barre" id="prix_barre" class="form-control @error('prix_barre') is-invalid @enderror" value="{{ old('prix_barre', $product->prix_barre) }}" step="0.01" min="0">
                                                        @error('prix_barre')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="quantity">Quantité *</label>
                                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $product->quantity) }}" min="0" required>
                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="link">Lien vidéo Facebook (optionnel)</label>
                                                <input type="url" class="form-control" id="link" name="link" 
                                                    value="{{ old('link', $product->link ?? '') }}"
                                                    placeholder="https://www.facebook.com/watch/?v=1234567890">
                                                <small class="form-text text-muted">
                                                    Lien vers une vidéo de démonstration du produit sur Facebook
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="front_image">Nouvelle image de face (optionnel)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="front_image" id="front_image" class="custom-file-input @error('front_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                                                    <label class="custom-file-label" for="front_image" id="frontImageLabel">
                                                        Choisir une nouvelle image...
                                                    </label>
                                                </div>
                                                @error('front_image')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="mt-2">
                                                    <strong>Image actuelle :</strong>
                                                    @if($product->front_image)
                                                        <img src="{{ asset('storage/'.$product->front_image) }}" 
                                                             alt="Image de face" 
                                                             class="img-fluid rounded"
                                                             style="max-height: 150px;">
                                                        <small class="d-block text-muted">
                                                            {{ basename($product->front_image) }}
                                                        </small>
                                                    @else
                                                        <span class="text-muted">Aucune image</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="back_image">Nouvelle image de l'arrière (optionnel)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="back_image" id="back_image" class="custom-file-input @error('back_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                                                    <label class="custom-file-label" for="back_image" id="backImageLabel">
                                                        Choisir une nouvelle image...
                                                    </label>
                                                </div>
                                                @error('back_image')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="mt-2">
                                                    <strong>Image actuelle :</strong>
                                                    @if($product->back_image)
                                                        <img src="{{ asset('storage/'.$product->back_image) }}" 
                                                             alt="Image de l'arrière" 
                                                             class="img-fluid rounded"
                                                             style="max-height: 150px;">
                                                        <small class="d-block text-muted">
                                                            {{ basename($product->back_image) }}
                                                        </small>
                                                    @else
                                                        <span class="text-muted">Aucune image</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Mettre à jour
                                        </button>
                                        <a href="{{ route('admin.products.list') }}" class="btn btn-default">
                                            <i class="fas fa-arrow-left"></i> Retour à la liste
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End section form --}}
    </div>
@endsection

@section('scripts')
<script>
    // Gestion de l'affichage du nom des fichiers
    function setupFileInput(inputId, labelId) {
        const input = document.getElementById(inputId);
        const label = document.getElementById(labelId);
        
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                label.textContent = this.files[0].name;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        setupFileInput('front_image', 'frontImageLabel');
        setupFileInput('back_image', 'backImageLabel');
        
        bsCustomFileInput.init();
    });
</script>
@endsection