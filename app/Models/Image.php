<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [

        'url',
        'product_id',

    ];
    public function product(){

        return $this->belongsTo(Product::class);

    }
}
