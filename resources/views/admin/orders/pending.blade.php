@extends('admin.layout')

@section('title')
    Commandes en attente
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Commandes en attente</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Commandes</a></li>
                            <li class="breadcrumb-item active">En attente</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section content --}}
        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($orders->isEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                <h4>Aucune commande en attente</h4>
                                <p class="text-muted">Toutes les commandes sont traitées !</p>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                                    <i class="fas fa-list"></i> Voir toutes les commandes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    @foreach($orders as $orderItem)
                    <div class="col-md-6" id="order-{{ $orderItem->id }}">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Commande #{{ $orderItem->id }}</h3>
                                <div class="card-tools">
                                    <span class="badge badge-light">{{ $orderItem->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong><i class="fas fa-user mr-1"></i> Client:</strong><br>
                                        @if($orderItem->user)
                                            {{ $orderItem->user->name }}<br>
                                            <small class="text-muted">{{ $orderItem->user->phone ?? 'N/A' }}</small>
                                        @else
                                            Client invité
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-money-bill-wave mr-1"></i> Total:</strong> 
                                        {{ number_format($orderItem->total_amount, 0, ',', ' ') }} FG<br>
                                        <strong><i class="fas fa-phone mr-1"></i> Paiement:</strong> 
                                        {{ $orderItem->payment_number }}
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-truck mr-1"></i> Livraison:</strong><br>
                                    {{ $orderItem->shipping_address }}
                                </div>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-boxes mr-1"></i> Produits:</strong>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($orderItem->items as $item)
                                        <li>• {{ $item->product->name }} x{{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.orders.approve', $orderItem->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Confirmez-vous la validation de cette commande ?')">
                                            <i class="fas fa-check"></i> Valider (Paiement reçu)
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.orders.reject', $orderItem->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Confirmez-vous le refus de cette commande ?')">
                                            <i class="fas fa-times"></i> Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
    </div>
@endsection