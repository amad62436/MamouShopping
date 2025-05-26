<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'quantity',
        'front_image',
        'back_image',
        'category_id',
        'is_active', // Nouveau champ
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
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
