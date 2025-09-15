<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', 
        'is_active', 
        'image',
    ]; 

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeWithBasicInfo($query)
    {
        return $query->select('id', 'name', 'slug', 'image');
    }
     protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::deleting(function ($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        });
    }

     public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeOptimized($query)
    {
        return $query->select(array_merge(['id'], $this->fillable));
    }
}