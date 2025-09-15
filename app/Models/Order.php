<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_number',
        'payment_status',
        'invoice_generated',
    ];


    // SCOPES OPTIMISÉS
    public function scopeForUser($query, $userId = null)
    {
        return $query->where('user_id', $userId ?? Auth::id());
    }

    public function scopeWithBasicInfo($query)
    {
        return $query->select('id', 'user_id', 'total_amount', 'status', 'payment_status', 'created_at');
    }

    public function scopeWithFullInfo($query)
    {
        return $query->select('id', 'user_id', 'total_amount', 'status', 'shipping_address', 'payment_number', 'payment_status', 'created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    // Vérifier si l'utilisateur est propriétaire
    public function isOwnedBy($userId)
    {
        return $this->user_id == $userId;
    }

    public function scopeOptimized($query)
    {
        return $query->select(array_merge(['id'], $this->fillable));
    }
}