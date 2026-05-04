<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'image',
        'faction',
        'unit_type',
        'material',
        'condition',
        'base_size',
        'points',
        'stock',
        'price',
        'is_active',
    ];

    /**
     * Get all of the figure's sale items.
     */
    public function saleItems()
    {
        return $this->morphMany(SaleItem::class, 'sellable');
    }
}
