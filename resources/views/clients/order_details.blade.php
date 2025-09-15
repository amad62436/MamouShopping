@extends('clients.layout')

@section('title')
    Détails de la commande #{{ $order->id }}
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Détails de la <strong>Commande #{{ $order->id }}</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Area -->
    <section class="order-details-area section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Résumé de la commande</h5>
                                <span class="badge 
                                    @if($order->status == 'pending') badge-warning
                                    @elseif($order->status == 'paid') badge-success
                                    @elseif($order->status == 'cancelled') badge-danger
                                    @else badge-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Informations client</h6>
                                    <p><strong>Nom Complet:</strong> {{ $order->user->name ?? 'Client invité' }}</p>
                                    <p><strong>Téléphone:</strong> {{ $order->payment_number }}</p>
                                    <p><strong>Email:</strong> {{ $order->user->email ?? 'Non spécifié' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Détails de la commande</h6>
                                    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
                                    <p><strong>Paiement:</strong> 
                                        <span class="badge 
                                            @if($order->payment_status == 'pending') badge-warning
                                            @elseif($order->payment_status == 'confirmed') badge-success
                                            @else badge-secondary @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <h6>Adresse de livraison</h6>
                            <p>{{ $order->shipping_address }}</p>

                            @if($order->notes)
                            <hr>
                            <h6>Notes supplémentaires</h6>
                            <p class="text-muted">{{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Products Details -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Produits commandés</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
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
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $item->product->front_image) }}" 
                                                         alt="{{ $item->product->name }}"
                                                         width="60" 
                                                         class="mr-3 rounded"
                                                         loading="lazy"
                                                         onerror="this.src='{{ asset('clients/img/product-img/default-product.png') }}'">
                                                    <div>
                                                        <strong>{{ $item->product->name }}</strong><br>
                                                        @if($item->product->link)
                                                            <small>
                                                                <a href="{{ $item->product->link }}">Voir la vidéo sur fb</a>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item->price, 0, ',', ' ') }} FG</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><strong>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FG</strong></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Sous-total:</strong></td>
                                            <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Livraison:</strong></td>
                                            <td><strong>Gratuite</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                            <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="text-center mt-4">
                        <a href="{{ route('orders.history') }}" class="btn btn-outline-primary">
                            <i class="icofont-arrow-left"></i> Retour à l'historique
                        </a>
                        
                        @if($order->invoice_generated && $order->invoice)
                        <a href="{{ route('invoices.show', $order->id) }}" class="btn btn-success ml-2">
                            <i class="icofont-file-document"></i> Voir la facture
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection