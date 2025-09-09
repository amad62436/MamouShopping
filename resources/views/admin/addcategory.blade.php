@extends('admin.layout')

@section('title')
    Ajouter une Catégorie
@endsection

@section('content')  
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ajouter une Catégorie</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.list') }}">Catégories</a></li>
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
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Nouvelle Catégorie</h3>
                            </div>
                            
                            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
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

                                    <div class="form-group">
                                        <label for="name">Nom de la catégorie *</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Ex: Électronique, Vêtements...">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image de la catégorie *</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif" required>
                                            <label class="custom-file-label" for="image" id="imageLabel">Choisir une image...</label>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Formats acceptés: JPG, PNG, GIF. Max: 2MB. L'image sera automatiquement optimisée.
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_preview">Aperçu de l'image</label>
                                        <div id="image_preview" class="border p-2 text-center" style="display: none;">
                                            <img id="preview" src="#" alt="Aperçu" class="img-fluid" style="max-height: 200px; display: none;">
                                            <p class="text-muted mt-2" id="preview_text">Aperçu de l'image</p>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Enregistrer la catégorie
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
    // Aperçu de l'image avant upload
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const previewText = document.getElementById('preview_text');
        const previewContainer = document.getElementById('image_preview');
        const imageLabel = document.getElementById('imageLabel');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                previewText.style.display = 'none';
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
            
            // Afficher le nom du fichier dans le label
            const fileName = this.files[0].name;
            imageLabel.textContent = fileName;
        }
    });

    // Empêcher la réinitialisation du formulaire en cas d'erreur
    document.addEventListener('DOMContentLoaded', function() {
        // Conserver la valeur du fichier en cas de rechargement de page
        const imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            const fileName = imageInput.files[0].name;
            document.getElementById('imageLabel').textContent = fileName;
        }

        // Bootstrap file input
        bsCustomFileInput.init();
        
        // Réappliquer le style Bootstrap après un rechargement
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection