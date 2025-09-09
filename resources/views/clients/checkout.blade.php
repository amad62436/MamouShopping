@extends('clients.layout')

@section('title')
    Commander
@endsection

@section('content')

    <!-- Hero Area -->
    <div class="demo-hero-area bg-gray text-center section_padding_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9">
                    <h2 class="mb-4">Finaliser votre <strong>Commande</strong></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Area -->
    <section class="checkout-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="checkout-form">
                        <h5>Informations de livraison</h5>
                        
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="shipping_address">Lieu de livraison *</label>
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address" 
                                       value="{{ old('shipping_address') }}" 
                                       placeholder="Ex: Maison des jeunes de Mamou, Terrain de basket de Mamou, Carrefour Sabou" 
                                       required>
                                <small class="form-text text-muted">
                                    Indiquez un lieu précis à Mamou pour la livraison
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="phone">Votre numero de tеléphone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="Ex: +224 621 12 34 56" 
                                       required>
                                <small class="form-text text-muted">
                                    Numéro où vous recevrez l'appel du livreur
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="payment_number">Numéro Orange Money pour le paiement *</label>
                                <input type="tel" class="form-control" id="payment_number" name="payment_number" 
                                       value="{{ old('payment_number') }}" 
                                       placeholder="Ex: +224 621 98 76 54" 
                                       required>
                                <small class="form-text text-muted">
                                    Numéro où vous effectuerez le paiement
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes (optionnel)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2" 
                                          placeholder="Ex: Appelez-moi avant de venir, Livrer avant 18h">{{ old('notes') }}</textarea>
                                <small>Instructions spéciales pour la livraison</small>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg">Confirmer la commande</button>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="order-summary">
                        <h5>Récapitulatif de la commande</h5>
                        
                        <div class="summary-items">
                            @foreach($cart as $item)
                            <div class="summary-item d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FG</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="summary-total mt-3 pt-3 border-top">
                            <div class="d-flex justify-content-between">
                                <strong>Sous-total:</strong>
                                <strong>{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 0, ',', ' ') }} FG</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <strong>Livraison:</strong>
                                <strong>Gratuite</strong>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <strong>Total:</strong>
                                <strong>{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 0, ',', ' ') }} FG</strong>
                            </div>
                        </div>

                        <div class="payment-info mt-4 p-3 bg-light rounded">
                            <h6>💡 Après confirmation :</h6>
                            <p class="mb-1">1. Vous serez redirigé vers les instructions de paiement.</p>
                            <p class="mb-1">2. Effectuez le paiement via Orange Money avec <b>les frais de retrait</b>.</p>
                            <p class="mb-0">3. Attendez la validation par l'administrateur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection