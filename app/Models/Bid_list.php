<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid_list extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bid_id',
        'user_id',
        'bid_amount',
    ];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
