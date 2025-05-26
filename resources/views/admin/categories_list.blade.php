@extends('admin.layout')

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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Toutes les categories</h3>
                            </div>
                            <div class="card-body">

                                {{-- Message de succès --}}
                                @if (Session::has("status"))
                                    <div class="alert alert-success">
                                        {{Session::get("status")}}
                                    </div>
                                @endif

                                <table id="example1" class="table table-bordered table-striped">
                                <input type="hidden" {{$increment = 1}}>
                                    <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Nom</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td>{{ $category->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{url('admin/editcategory/'.$category->id)}}" class="btn btn-primary btn-sm">Modifier</a>
                                                    <form action="{{url('admin/deletecategory/'.$category->id)}}" method="POST" style="display:inline;" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" id="delete" class="btn btn-danger" value="Supprimer">
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
  