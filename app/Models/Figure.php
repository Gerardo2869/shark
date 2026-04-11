<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
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
}
