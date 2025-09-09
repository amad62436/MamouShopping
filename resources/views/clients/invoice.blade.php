@extends('clients.layout')

@section('title')
    Facture #{{ $order->invoice->invoice_number }}
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Votre <strong>Facture</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Area -->
    <section class="invoice-area section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                Facture #{{ $order->invoice->invoice_number }}
                                <span class="badge badge-success ml-2">Payée</span>
                            </h5>
                            <div class="card-tools">
                                <a href="{{ route('invoices.download', $order->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i> Télécharger PDF
                                </a>
                                <a href="{{ route('invoices.preview', $order->id) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-eye"></i> Aperçu
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <h6>Informations client</h6>
                                    <p>
                                        <strong>{{ $order->user->name ?? 'Client invité' }}</strong><br>
                                        {{ $order->user->phone ?? $order->payment_number }}<br>
                                        {{ $order->shipping_address }}
                                    </p>
                                </div>
                                <div class="col-6 text-right">
                                    <h6>Détails de la facture</h6>
                                    <p>
                                        <strong>Date:</strong> {{ $order->invoice->issued_at->format('d/m/Y') }}<br>
                                        <strong>Commande #:</strong> {{ $order->id }}<br>
                                        <strong>Statut:</strong> Payée
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ number_format($item->price, 0, ',', ' ') }} FG</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FG</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sous-total:</th>
                                            <th>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Livraison:</th>
                                            <th>Gratuite</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <th>{{ number_format($order->total_amount, 0, ',', ' ') }} FG</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <p class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Cette facture a été générée automatiquement le 
                                        {{ $order->invoice->issued_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('orders.history') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Retour à mes commandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection