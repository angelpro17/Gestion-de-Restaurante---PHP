<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available' => 'boolean',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    /**
     * Scope para filtrar por categoría.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope para buscar productos por nombre.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
    }

    /**
     * Accessor para obtener el precio formateado.
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Accessor para obtener la URL de la imagen.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/products/' . $this->image);
        }
        return asset('images/no-image.png'); // Imagen por defecto
    }

    /**
     * Verifica si el producto está disponible.
     */
    public function isAvailable()
    {
        return $this->available;
    }

    /**
     * Marca el producto como disponible.
     */
    public function markAsAvailable()
    {
        $this->update(['available' => true]);
    }

    /**
     * Marca el producto como no disponible.
     */
    public function markAsUnavailable()
    {
        $this->update(['available' => false]);
    }

    /**
     * Obtiene todas las categorías únicas.
     */
    public static function getCategories()
    {
        return self::distinct('category')
                  ->whereNotNull('category')
                  ->pluck('category')
                  ->sort()
                  ->values();
    }
    
}
