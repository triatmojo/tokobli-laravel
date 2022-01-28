<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'products_id', 'users_id'
    ];

    protected $hidde = [];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }
}
