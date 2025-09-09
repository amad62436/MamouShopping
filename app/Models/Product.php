<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'link',
        'price',
        'quantity',
        'front_image',
        'back_image',
        'category_id',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Méthode pour obtenir la quantité commandée (dans les commandes en attente)
    public function getOrderedQuantity()
    {
        return $this->orderItems()
            ->whereHas('order', function($query) {
                $query->whereIn('status', ['pending', 'paid', 'processing']);
            })
            ->sum('quantity');
    }

    // Méthode pour obtenir le stock réellement disponible
    public function getAvailableQuantity()
    {
        return $this->quantity - $this->getOrderedQuantity();
    }

     // Méthode pour désactiver automatiquement le produit si stock = 0
    public function updateStatusBasedOnStock()
    {
        if ($this->quantity <= 0 && $this->is_active) {
            $this->is_active = false;
            $this->save();
        }
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }

            // Vérification en temps réel du stock
            if ($product->isDirty('quantity')) {
                // Désactiver si stock = 0
                if ($product->quantity <= 0) {
                    $product->is_active = false;
                }
                // Réactiver si stock > 0
                elseif ($product->quantity > 0 && !$product->is_active) {
                    $product->is_active = true;
                }
            }
        });
        
        static::deleting(function ($product) {
            // Supprime les images lors de la suppression du produit
            if ($product->front_image) {
                Storage::disk('public')->delete($product->front_image);
            }
            if ($product->back_image) {
                Storage::disk('public')->delete($product->back_image);
            }
        });

        static::updating(function ($product) {
            $original = $product->getOriginal();
            
            // Supprime l'ancienne image de face si elle a changé
            if ($product->isDirty('front_image') && $original['front_image']) {
                Storage::disk('public')->delete($original['front_image']);
            }
            
            // Supprime l'ancienne image de dos si elle a changé
            if ($product->isDirty('back_image') && $original['back_image']) {
                Storage::disk('public')->delete($original['back_image']);
            }
        });
    }
}