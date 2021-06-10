<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_shop extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'shop_name',
        'owner_name',
        'number_phone',
        'image_profile',
        'addresses',




    ];

    public function ShopCart(){

        return $this->hasMany(ShopCart::class,'user_id','user_id');

    }
}
