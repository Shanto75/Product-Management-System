<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User_details extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'optional_phone',
        'gender',
        'img',
        'division',
        'district',
        'thana_upazila',
        'address',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
