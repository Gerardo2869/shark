<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name'];

    public function figures()
    {
        return $this->hasMany(Figure::class);
    }

    public function paints()
    {
        return $this->hasMany(Paint::class);
    }
}
