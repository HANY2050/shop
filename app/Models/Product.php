<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{



    use HasFactory;
    protected $fillable = [

        'title',
        'category_id',
        'description',
        'unit',
        'price',
        'total',
        'options',
        'discount',
        'user_id',
    ];
    public function images(){

        return $this->hasMany(Image::class);

    }

   public function reviews(){

      return $this->hasMany(Review::class);

    }
    public function category(){

    return $this->belongsTo(Category::class);

    }
    public function tags(){

       return $this->belongsToMany(Tag::class);

    }
    public function hasUnit(){

       return $this->belongsTo(Unit::class,'unit','id');


    }

    public function jsonOptions(){

  return json_decode($this->options);


    }
}
