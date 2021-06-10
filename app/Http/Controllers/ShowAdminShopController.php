<?php

namespace App\Http\Controllers;

use App\Models\Info_shop;
use App\Models\ShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowAdminShopController extends Controller
{
    public function index(){

        $shops = Info_shop::with(['ShopCart'])->paginate(env('PAGINATION_COUNT'));

       $user = Auth::user()->id;
        return view('admin.showAdminShop.show_shop_Admin')->with([
           'user'=>$user,
            'shops'=> $shops,

        ]);

    }
    public  function  Cart(){
        $shops = Info_shop::with(['ShopCart'])->paginate(env('PAGINATION_COUNT'));


        return view('admin.showAdminShop.more_info')->with([

            'shops'=> $shops,

        ]);


    }

    public function ShowUpdateAdmin($id){

        /*$shops = Info_shop::paginate(env('PAGINATION_COUNT'));
        $user = Auth::user()->id;
        return view('shop.update_shop')->with([
            'user'=>$user,
            'shops'=> $shops,

        ]);*/
        $shop = Info_shop::find($id);
        $cart = ShopCart::find($id);

  echo $cart;

        return view('admin.showAdminShop.more_info',compact('shop','cart'));


    }

}
