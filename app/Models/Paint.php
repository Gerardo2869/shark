<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paint extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'color_type',
        'stock',
        'price',
        'expiration_date',
        'finish',
        'code',
        'ml',
        'is_active',
    ];

    /**
     * Get all of the paint's sale items.
     */
    public function saleItems()
    {
        return $this->morphMany(SaleItem::class, 'sellable');
    }
}
