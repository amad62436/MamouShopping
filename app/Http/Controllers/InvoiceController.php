<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Afficher la facture
    public function show($orderId)
    {
        $order = Order::with(['user', 'items.product', 'invoice'])
                     ->findOrFail($orderId);

        // Vérifier que la facture existe
        if (!$order->invoice) {
            abort(404, 'Facture non trouvée');
        }

        return view('clients.invoice', compact('order'));
    }

    // Télécharger la facture en PDF
    public function download($orderId)
    {
        $order = Order::with(['user', 'items.product', 'invoice'])
                     ->findOrFail($orderId);

        // Vérifier que la facture existe
        if (!$order->invoice) {
            abort(404, 'Facture non trouvée');
        }

        $pdf = PDF::loadView('invoices.template', [
            'invoice' => $order->invoice,
            'order' => $order
        ]);

        return $pdf->download('facture-' . $order->invoice->invoice_number . '.pdf');
    }

    // Aperçu de la facture
    public function preview($orderId)
    {
        $order = Order::with(['user', 'items.product', 'invoice'])
                     ->findOrFail($orderId);

        // Vérifier que la facture existe
        if (!$order->invoice) {
            abort(404, 'Facture non trouvée');
        }

        $pdf = PDF::loadView('invoices.template', [
            'invoice' => $order->invoice,
            'order' => $order
        ]);

        return $pdf->stream('facture-' . $order->invoice->invoice_number . '.pdf');
    }
}