@extends('admin.layout')

@section('title')
    Ajouter un Produit
@endsection

@section('content')
<div class="content-wrapper">
    {{-- Section header --}}
    <section class="content-header">
        <div class="content-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ajouter un Produit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/produits_list') }}">Produits</a></li>
                        <li class="breadcrumb-item active">Ajouter</li>
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
                            <h3 class="card-title">Nouveau Produit</h3>
                        </div>
                        
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"  id="productForm">
                            <div class="card-body">
                                @csrf
                                
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
                                    {{-- Colonne gauche --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nom du produit *</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Ex: iPhone 13 Pro">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Type *</label>
                                            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" required placeholder="Ex: Téléphone, Chemise...">
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id">Catégorie *</label>
                                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                <option value="">Sélectionnez une catégorie</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0" required placeholder="0.00">
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
                                                    <input type="number" name="prix_barre" id="prix_barre" class="form-control @error('prix_barre') is-invalid @enderror" value="{{ old('prix_barre') }}" step="0.01" min="0" placeholder="0.00">
                                                    @error('prix_barre')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity">Quantité en stock *</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="0" required>
                                            @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Colonne droite --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Description détaillée du produit...">{{ old('description') }}</textarea>
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
                                            <label for="front_image">Image de face *</label>
                                            <div class="custom-file">
                                                <input type="file" name="front_image" id="front_image" class="custom-file-input @error('front_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif" required>
                                                <label class="custom-file-label" for="front_image">Choisir l'image de face...</label>
                                            </div>
                                            @error('front_image')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <small class="form-text text-muted">Format principal du produit</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="back_image">Image de l'arrière</label>
                                            <div class="custom-file">
                                                <input type="file" name="back_image" id="back_image" class="custom-file-input @error('back_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                                                <label class="custom-file-label" for="back_image">Choisir l'image de l'arrière...</label>
                                            </div>
                                            @error('back_image')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <small class="form-text text-muted">Optionnel - Vue arrière du produit</small>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="front_preview" class="border p-2 text-center mb-2" style="display: none;">
                                                    <img id="front_preview_img" src="#" alt="Aperçu face" class="img-fluid" style="max-height: 150px; display: none;">
                                                    <p class="text-muted mt-2" id="front_preview_text">Aperçu face</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="back_preview" class="border p-2 text-center mb-2" style="display: none;">
                                                    <img id="back_preview_img" src="#" alt="Aperçu dos" class="img-fluid" style="max-height: 150px; display: none;">
                                                    <p class="text-muted mt-2" id="back_preview_text">Aperçu dos</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Enregistrer le produit
                                    </button>
                                    <a href="{{ url('admin/produits_list') }}" class="btn btn-default">
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
    // Aperçu des images
    function setupImagePreview(inputId, previewId, previewImgId, previewTextId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const previewImg = document.getElementById(previewImgId);
        const previewText = document.getElementById(previewTextId);
        
        input.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    previewText.style.display = 'none';
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
                
                // Afficher le nom du fichier
                const fileName = this.files[0].name;
                this.nextElementSibling.textContent = fileName;
            }
        });
    }

    // Configuration des aperçus
    document.addEventListener('DOMContentLoaded', function() {
        setupImagePreview('front_image', 'front_preview', 'front_preview_img', 'front_preview_text');
        setupImagePreview('back_image', 'back_preview', 'back_preview_img', 'back_preview_text');
        
        // Bootstrap file input
        bsCustomFileInput.init();
    });
</script>
@endsection