@extends('clients.layout')

@section('title')
    Mes Commandes
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Mes <strong>Commandes</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders History Area -->
    <section class="orders-history-area section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    
                    @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <i class="icofont-cart fa-4x text-muted mb-4"></i>
                        <h4>Aucune commande passée</h4>
                        <p class="text-muted">Vous n'avez pas encore passé de commande.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="icofont-shopping-cart"></i> Commencer mes achats
                        </a>
                    </div>
                    @else
                    <div class="orders-list">
                        @foreach($orders as $order)
                        <div class="card order-card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">Commande #{{ $order->id }}</h5>
                                        <small class="text-muted">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</small>
                                    </div>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Informations de livraison</h6>
                                        <p class="mb-1"><strong>Lieu:</strong> {{ $order->shipping_address }}</p>
                                        <p class="mb-1"><strong>Téléphone:</strong> {{ $order->payment_number }}</p>
                                        <p class="mb-0"><strong>Total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Produits commandés</h6>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($order->items as $item)
                                            <li>• {{ $item->product->name }} x{{ $item->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Statut paiement:</strong>
                                        <span class="badge 
                                            @if($order->payment_status == 'pending') badge-warning
                                            @elseif($order->payment_status == 'confirmed') badge-success
                                            @else badge-secondary @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="order-actions">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="icofont-eye"></i> Détails
                                        </a>
                                        
                                        {{-- BOUTONS FACTURE AMÉLIORÉS --}}
                                        @if($order->invoice_generated && $order->invoice)
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('invoices.show', $order->id) }}" class="btn btn-success btn-sm">
                                                <i class="icofont-file-document"></i> Voir facture
                                            </a>
                                            <a href="{{ route('invoices.download', $order->id) }}" class="btn btn-info btn-sm" title="Télécharger PDF">
                                                <i class="icofont-download"></i>
                                            </a>
                                        </div>
                                        @elseif($order->status == 'paid')
                                        <span class="badge badge-info">Facture en préparation</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </section>

@endsection