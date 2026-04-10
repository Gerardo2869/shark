<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
    protected $fillable = [
        'name',
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
