<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id', 'product_id', 'stars' , 'review',


    ];
    public function customer(){

        return $this->belongsTo(User::class, 'user_id','id');

    }
    public function product(){


        return $this->belongsTo(Product::class);

    }

    public  function date_in_View(){

       return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();


    }
}
