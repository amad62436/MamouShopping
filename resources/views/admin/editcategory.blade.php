@extends('admin.layout')

@section('title')
    Modifier une categorie
@endsection

@section('content')  
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier une Catégorie</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.list') }}">Catégories</a></li>
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
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Modifier la catégorie</h3>
                            </div>
                            
                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="editCategoryForm">
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

                                    <div class="form-group">
                                        <label for="name">Nom de la catégorie *</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Nouvelle image (optionnel)</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                                            <label class="custom-file-label" for="image" id="imageLabel">
                                                Choisir une nouvelle image...
                                            </label>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Laisser vide pour conserver l'image actuelle.
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label>Image actuelle</label>
                                        <div>
                                            @if($category->image)
                                                <img src="{{ asset('storage/'.$category->image) }}" 
                                                     alt="{{ $category->name }}" 
                                                     class="img-fluid rounded"
                                                     style="max-height: 200px;">
                                                <small class="form-text text-muted">
                                                    {{ basename($category->image) }}
                                                </small>
                                            @else
                                                <span class="text-muted">Aucune image</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Mettre à jour
                                        </button>
                                        <a href="{{ route('admin.categories.list') }}" class="btn btn-default">
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
    // Gestion de l'affichage du nom du fichier
    document.getElementById('image').addEventListener('change', function(e) {
        const label = document.getElementById('imageLabel');
        if (this.files && this.files[0]) {
            label.textContent = this.files[0].name;
        }
    });

    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection