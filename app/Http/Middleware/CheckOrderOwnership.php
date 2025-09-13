<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CheckOrderOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $orderId = $request->route('id');
        
        $order = Order::find($orderId);
        
        if (!$order) {
            abort(404, 'Commande non trouvée.');
        }

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette commande.');
        }

        return $next($request);
    }
}