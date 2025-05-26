@extends('admin.layout')

@section('title')
    Categorie
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
                                <h3 class="card-title">Ajouter une categorie</h3>
                            </div>
                            
                            <form action="{{ url('admin/savecategory') }}" method="POST">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
  