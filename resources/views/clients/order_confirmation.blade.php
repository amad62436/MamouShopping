@extends('clients.layout')

@section('title')
    Confirmation de commande
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Commande <strong>En Attente</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Area -->
    <section class="confirmation-area section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="confirmation-card text-center">
                        
                        {{-- Vérification que $order existe --}}
                        @if(isset($order) && $order)
                        
                        @if($order->status == 'paid' && $order->invoice_generated)
                        {{-- COMMANDE VALIDÉE AVEC FACTURE --}}
                        <div class="success-icon mb-4">
                            <i class="icofont-check-circled" style="font-size: 80px; color: #28a745;"></i>
                        </div>
                        
                        <h3 class="mb-3">Commande #{{ $order->id }} Validée !</h3>
                        <p class="mb-4">Votre commande a été confirmée et est en cours de préparation.</p>

                        <div class="order-details mb-4">
                            <p><strong>Total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
                            <p><strong>Statut:</strong> <span class="badge badge-success">Payée</span></p>
                            <p><strong>Lieu de livraison:</strong> {{ $order->shipping_address }}</p>
                            <p><strong>Numéro de contact:</strong> {{ $order->payment_number }}</p>
                        </div>

                        {{-- SECTION FACTURE --}}
                        <div class="invoice-section mb-4 p-4 bg-light rounded">
                            <h5><i class="icofont-file-document"></i> Votre facture est disponible</h5>
                            <p>Vous pouvez consulter et télécharger votre facture dès maintenant.</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('invoices.show', $order->id) }}" class="btn btn-success">
                                    <i class="icofont-file-document"></i> Voir la facture
                                </a>
                                <a href="{{ route('invoices.download', $order->id) }}" class="btn btn-primary">
                                    <i class="icofont-download"></i> Télécharger
                                </a>
                            </div>
                        </div>

                        @else
                        {{-- COMMANDE EN ATTENTE --}}
                        <div class="warning-icon mb-4">
                            <i class="icofont-wall-clock" style="font-size: 80px; color: #ffc107;"></i>
                        </div>
                        
                        <h3 class="mb-3">Commande #{{ $order->id }} en attente</h3>
                        <p class="mb-4">Votre commande est en attente de validation et de paiement.</p>

                        <div class="order-details mb-4">
                            <p><strong>Total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
                            <p><strong>Statut:</strong> <span class="badge badge-warning">En attente</span></p>
                            <p><strong>Lieu de livraison:</strong> {{ $order->shipping_address }}</p>
                            <p><strong>Numéro de paiement:</strong> {{ $order->payment_number }}</p>
                        </div>

                        <div class="payment-instructions mb-4 p-4 bg-light border rounded">
                            <h5><i class="icofont-info-circle"></i> Instructions de paiement:</h5>
                            <p class="mb-2">1. Effectuez le paiement avec les frais de retrait de <strong class="bg-warning p-1 rounded">{{ number_format($order->total_amount, 0, ',', ' ') }} FG</strong></p>
                            <p class="mb-2">2. Sur le numéro Orange Money: <strong class="bg-warning p-1 rounded">+224 621 30 47 08</strong> ou Mobile Money: <strong class="bg-warning p-1 rounded">+224 663 70 04 22.</strong></p>
                            <p class="mb-2">3. Une fois votre paiement validé, vous recevrez un appel pour la livraison.</p>
                        </div>

                        @endif

                        @else
                        {{-- Message si $order n'existe pas --}}
                        <div class="alert alert-danger">
                            <h4><i class="icofont-close-circled"></i> Erreur</h4>
                            <p>Impossible de trouver les détails de la commande.</p>
                            <p>Veuillez contacter le support si le problème persiste.</p>
                        </div>
                        @endif

                        <div class="confirmation-buttons mt-4">
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i class="icofont-shopping-cart"></i> Continuer les achats
                            </a>
                            <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary">
                                <i class="icofont-history"></i> Voir mes commandes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection