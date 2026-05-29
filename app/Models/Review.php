<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'productVariant_id', 'review', 'name', 'email'
    ];
    public function productVariant() {
        return $this->belongsTo(ProductVariant::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
