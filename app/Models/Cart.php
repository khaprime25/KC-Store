<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'productVariant_id',
        'quantity',
    ];

    // Cart belongs to one product variant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'productVariant_id');
    }

    // Cart belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}