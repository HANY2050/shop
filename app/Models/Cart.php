<?php

namespace App\Models;

use App\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [

        'cart_items',
        'total',
        'user_id',




    ];

    public function user(){
     return $this->belongsTo(User::class);

    }
    public  function order(){

        return $this->belongsTo(Order::class);
    }
   /* public function cartItems(){
if(is_null($this->cart_items)){

    $this->cart_items =[];
    return $this->cart_items ;
}
return json_decode($this->cart_items);

    }*/

    public function increasezProductsInCart(Product $product,$qty = 1){
        $cartItems = $this->cart_items;
        if(is_null($cartItems)){
            $cartItems=[];
        }else{
            if(!is_array($cartItems)){

                $cartItems = json_decode($this->cart_items);
            }
        }

        /**
         * @var $cartItem CartItem
         */

        foreach ($cartItems as $cartItem){
            if($cartItem->product->id === $product->id){
           $cartItem->qty += $qty;
            }
        }
        $this->cart_items = json_encode($cartItems);
        $tempTotal = 0;
        foreach ($cartItems as $cartItem){
            $tempTotal += ($cartItem->qty * $cartItem->product->price);
        }
        $this->total = $tempTotal;
    }


    public function decreaseProduct(Product $product){

        $cartItems = $this->cart_items;
        if(is_null($cartItems)){
            $cartItems=[];
        }else{
            if(!is_array($cartItems)){

                $cartItems = json_decode($this->cart_items);
            }
        }

        /**
         * @var $cartItem CartItem
         */

        foreach ($cartItems as $cartItem){
            if($cartItem->product->id === $product->id){
                $cartItem->qty --;
            }
        }
        $this->cart_items = json_encode($cartItems);
        $tempTotal = 0;
        foreach ($cartItems as $cartItem){
            $tempTotal += ($cartItem->qty * $cartItem->product->price);
        }
        $this->total = $tempTotal;
    }





    public function addProductsInCart(Product $product , $qty = 1){
        $cartItems = $this->cart_items;
        if(is_null($cartItems)){
            $cartItems=[];
        }else{
            if(!is_array($cartItems)){

                $cartItems = json_decode($this->cart_items);
            }
        }

      /**
       * @var $cartItem CartItem
       */
        $cartItem= new CartItem($product ,$qty);
        array_push($cartItems , $cartItem);
        $this->cart_items = json_encode($cartItems);
        $tempTotal = 0;
        foreach ($cartItems as $cartItem){
            $tempTotal += ($cartItem->qty * $cartItem->product->price);
        }
        $this->total = $tempTotal;
    }




public function inItems($product_id){
    $cartItems = $this->cart_items;

    if(is_null($cartItems)){
        $cartItems=[];
    }else{
        if(!is_array($cartItems)){

            $cartItems = json_decode($this->cart_items);
        }

    }

/**
 * @var $cartItem CartItem
 */
foreach ($cartItems as $cartItem){
 if($product_id == $cartItem->product->id ){

return true;
 }

}
return false;
}

}
