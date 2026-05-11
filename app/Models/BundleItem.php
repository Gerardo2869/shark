<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleItem extends Model
{
    protected $fillable = [
        'bundle_id',
        'sellable_type',
        'sellable_id',
        'quantity',
    ];

    /**
     * Get the parent bundle.
     */
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    /**
     * Get the sellable item (Paint or Figure).
     */
    public function sellable()
    {
        return $this->morphTo();
    }
}
