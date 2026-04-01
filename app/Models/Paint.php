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
    ];
}
