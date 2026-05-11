<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'is_active',
    ];

    /**
     * Get the items that make up this bundle.
     */
    public function items()
    {
        return $this->hasMany(BundleItem::class);
    }
}
