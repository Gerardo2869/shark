<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class QuoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'quotable_type',
        'quotable_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    /**
     * Get the quote that owns this item.
     */
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * Get the parent quotable model (Paint or Figure).
     */
    public function quotable(): MorphTo
    {
        return $this->morphTo();
    }
}
