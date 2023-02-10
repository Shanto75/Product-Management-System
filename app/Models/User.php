<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends  Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'phone',
        'email',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function user_details(){
        return $this->hasOne(User_details::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
