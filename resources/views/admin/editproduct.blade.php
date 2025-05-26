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
                        <h1>Categorie</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Category</a></li>
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
                                <h3 class="card-title">Modifier un produit</h3>
                            </div>
                            
                            <form action="{{ url('admin/updateproduct/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                    </div>
                                     <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" name="type" class="form-control" value="{{ old('type', $product->type) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Prix</label>
                                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prix_barre">Prix barré</label>
                                        <input type="number" name="prix_barre" id="prix_barre" class="form-control" value="{{ old('prix_barre', $product->prix_barre ?? 0) }}"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantité</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity ) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="front_image">Image de face</label>
                                        <input type="file" name="front_image" class="form-control">
                                        @if($product->front_image)
                                            <small class="text-muted">Image actuelle: {{ basename($product->front_image) }}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="back_image">Image de l'arrière</label>
                                        <input type="file" name="back_image" class="form-control">
                                        @if($product->back_image)
                                            <small class="text-muted">Image actuelle: {{ basename($product->back_image) }}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Catégorie</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
  