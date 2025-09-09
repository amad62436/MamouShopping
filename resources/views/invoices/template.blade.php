<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .company-info { margin-bottom: 30px; }
        .invoice-info { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-section { margin-top: 20px; }
        .footer { margin-top: 50px; font-size: 11px; text-align: center; }
        .product-image { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
        .logo { width: 120px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <!-- Logo MamouShopping -->
        <img src="{{ public_path('clients/img/core-img/logo.png') }}" class="logo" alt="MamouShopping Logo">
        <h2>Mamou Shopping</h2>
        <p>Votre boutique en ligne !</p>
    </div>

    <div class="company-info">
        <p><strong>Téléphone:</strong> +224 621 30 47 08</p>
        <p><strong>Email:</strong> contact@mamoushopping.com</p>
        <p><strong>Adresse:</strong> Mamou, République de Guinée</p>
    </div>

    <div class="invoice-info">
        <p><strong>Facture N°:</strong> {{ $invoice->invoice_number }}</p>
        <p><strong>Date:</strong> {{ $invoice->issued_at->format('d/m/Y H:i') }}</p>
        <p><strong>Commande N°:</strong> #{{ $order->id }}</p>
        <p><strong>Client:</strong> {{ $order->user->name ?? 'Client invité' }}</p>
        <p><strong>Téléphone du client:</strong> {{ $order->user->phone ?? $order->payment_number }}</p>
    </div>

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
                    <strong>{{ $item->product->name }}</strong>
                    <br>
                    <br>
                    <!-- Image du produit -->
                    <img src="{{ storage_path('app/public/' . $item->product->front_image) }}" 
                         class="product-image" 
                         alt="{{ $item->product->name }}"
                         onerror="this.style.display='none'">
                    {{-- Vidéo fb  --}}
                    @if($item->product->link)
                    <br><br>
                        <small>
                            <a href="{{ $item->product->link }}">Voir la vidéo sur fb</a>
                        </small>
                    @endif
                </td>
                <td>{{ number_format($item->price, 0, ',', ' ') }} FG</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FG</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section text-right">
        <p><strong>Sous-total:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
        <p><strong>Livraison: Gratuite</strong></p>
        <p><strong>Total TTC:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FG</p>
    </div>

    <div class="footer">
        <p>Merci pour votre confiance !</p>
        <p>Mamou Shopping - <strong>votre satisfaction est notre priorité</strong></p>
        <p>Facture générée le: <strong>{{ now()->format('d/m/Y H:i') }}</strong></p>
    </div>
</body>
</html>