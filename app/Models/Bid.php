<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'details',
        'quantity',
        'price_start',
        'price_end',
        'sold_price',
        'user_id',
        'buyer_id',
        'rider_id',
        'bid_start',
        'bid_end',
        'sold',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->with('user_details');
    }
    public function bid_list(){
        return $this->hasMany(Bid_list::class);
    }

}
