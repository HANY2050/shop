<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller

{


public function removeProductFromCart($id){
    $product = Product::find($id);
    $user = Auth::user();





    /**
     * @var Cart
     */

    $cart =$user->cart;
    if(is_null($cart)){
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->cart_items = [];
        $cart->total = 0;

    }

    if($cart->inItems($id)){

        $cart->decreaseProduct($product);
    }
    /*return $cart;*/
    $cart->save();

    $user->cart_id = $cart->id;
    $user->save();
    return $cart;




}

    public function index(){

        $user = Auth::user();
        $cart =$user->cart;
        $cartItems = json_decode($cart->cart_items);
        $finalCartItems = [];
        foreach ($cartItems as $cartItem){
            $product = Product::find(intval($cartItem->product->id));
            $finalCartItem= new \stdClass();
            $finalCartItem->product = new ProductResource($product);
            $finalCartItem->qty = number_format(doubleval($cartItem->qty) , 2);
            array_push($finalCartItems  , $finalCartItem );

        }
        return [

            'cart_items' => $finalCartItems,
            'id'=>$cart->id,
            'total'=>$cart->total,

        ];

    }

    public function addProductToCart(Request $request)
    {
        $request->validate([

            'product_id'=>'required',
            'qty'=>'required',
        ]);
  $user = Auth::user();

  $product_id = $request->input('product_id');
        $qty = $request->input('qty');
  $product = Product::findOrFail($product_id);


        /**
         * @var Cart
         */

       $cart =$user->cart;
        if(is_null($cart)){
    $cart = new Cart();
    $cart->user_id = $user->id;
    $cart->cart_items = [];
    $cart->total = 0;

        }

  /*$cart = $this->checkCartStatus($user->cart) ;*/

  /*return[

     'response' => ($cart->inItems( $product_id ))
  ];*/

 if($cart->inItems($product_id)){

$cart->increasezProductsInCart($product,$qty);
 }else{

 $cart->addProductsInCart($product,$qty);


 }
/*return $cart;*/
 $cart->save();

 $user->cart_id = $cart->id;
 $user->save();
 return $cart;



    }
    /*private function checkCartStatus(Cart $cart = null){
if(is_null($cart)){
$cart = new Cart();
$cart->cart_items = [];
$cart->total = 0;
$cart->user_id = Auth::user()->id;
return $cart;
}
return $cart;
}*/


}
