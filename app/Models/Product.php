<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'buyer_id',
        'rider_id',
        'status',
        'sold',
        'product_name',
        'details',
        'quantity',
        'price_start',
        'price_end',
        'sold_price',
        'production_start',
        'production_end',
        'sold_date',
        'total_produced',
        'production_cost',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bid(){
        return $this->hasMany(Bid::class);
    }
}
