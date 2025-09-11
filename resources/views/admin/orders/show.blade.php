@extends('admin.layout')

@section('title')
    Détails de la commande #{{ $order->id }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Section header -->
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Détails de la commande #{{ $order->id }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Commandes</a></li>
                            <li class="breadcrumb-item active">Détails</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                        <!-- Card principale -->
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Informations de la commande</h3>
                                    <div>
                                        <span class="badge 
                                            @if($order->status == 'pending') badge-warning
                                            @elseif($order->status == 'paid') badge-success
                                            @elseif($order->status == 'cancelled') badge-danger
                                            @else badge-secondary @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <!-- Informations client -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-user"></i> Informations client</h5>
                                        <div class="pl-3">
                                            <p><strong>Nom:</strong> {{ $order->user->name ?? 'Client invité' }}</p>
                                            <p><strong>Email:</strong> {{ $order->user->email ?? 'Non spécifié' }}</p>
                                            <p><strong>Télephone:</strong> {{ $order->user->phone ?? 'Non spécifié' }}</p>
                                            <p><strong>Numéro de paiement:</strong> {{ $order->payment_number }}</p>
                                            <p><strong>ID Client:</strong> {{ $order->user_id ?? 'Invité' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-receipt"></i> Détails commande</h5>
                                        <div class="pl-3">
                                            <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                                            <p><strong>Total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
                                            <p><strong>Statut paiement:</strong> 
                                                <span class="badge 
                                                    @if($order->payment_status == 'pending') badge-warning
                                                    @elseif($order->payment_status == 'confirmed') badge-success
                                                    @else badge-secondary @endif">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </p>
                                            @if($order->invoice)
                                            <p><strong>Facture:</strong> {{ $order->invoice->invoice_number }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Adresse de livraison -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5><i class="fas fa-truck"></i> Adresse de livraison</h5>
                                        <div class="pl-3">
                                            <p class="bg-light p-3 rounded">{{ $order->shipping_address }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Produits commandés -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5><i class="fas fa-boxes"></i> Produits commandés</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Produit</th>
                                                        <th>Prix unitaire</th>
                                                        <th>Quantité</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('storage/' . $item->product->front_image) }}" 
                                                                 alt="{{ $item->product->name }}"
                                                                 width="50"
                                                                 class="img-thumbnail"
                                                                 onerror="this.src='{{ asset('admin/dist/img/default-product.png') }}'">
                                                        </td>
                                                        <td>
                                                            <strong>{{ $item->product->name }}</strong><br>
                                                            <small class="text-muted">Catégorie: {{ $item->product->category->name }}</small>
                                                        </td>
                                                        <td>{{ number_format($item->price, 0, ',', ' ') }} FG</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td><strong>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FG</strong></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>Sous-total:</strong></td>
                                                        <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>Livraison:</strong></td>
                                                        <td>Gratuite</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>Total général:</strong></td>
                                                        <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions admin -->
                                @if($order->status == 'pending')
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5><i class="fas fa-cogs"></i> Actions administrateur</h5>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Confirmer la validation de cette commande ?')">
                                                    <i class="fas fa-check"></i> Valider la commande
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer le refus de cette commande ?')">
                                                    <i class="fas fa-times"></i> Refuser la commande
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Retour à la liste
                                </a>
                                
                                @if($order->invoice)
                                <a href="{{ route('invoices.download', $order->id) }}" class="btn btn-info ml-2" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger facture
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection