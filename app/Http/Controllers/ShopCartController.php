<?php

namespace App\Http\Controllers;

use App\Models\ShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopCartController extends Controller
{
   public  function  index(){
   $ShopCart = ShopCart::paginate(env('PAGINATION_COUNT'));
   $user = Auth::user()->id;
       return view('shopCart.shopCart')->with([
           'user'=>$user,
           'ShopCart'=> $ShopCart,

       ]);


   }

    public function store(Request $request){


        $request->validate([

            'user_id' => 'required',
            'photo_car' => 'required',



        ]);



        $ShopCart = new ShopCart();
        $ShopCart ->user_id = $request->input('user_id');
        //$infoShop ->photo_car = $request->input('photo_car');
        if($request->hasFile('photo_car')){
            $images = $request->file('photo_car');
            $imageName =time().'.'.$images->extension();
            $images->move(public_path(),$imageName);
            $ShopCart ->photo_car = $imageName;
        }
        $ShopCart ->save();

       return redirect(route('Shop_Cart'))->with('success',' تم حفظ البيانات بنجاح' );


    }

    public function ShowUpdate($id){

        /*$shops = Info_shop::paginate(env('PAGINATION_COUNT'));
        $user = Auth::user()->id;
        return view('shop.update_shop')->with([
            'user'=>$user,
            'shops'=> $shops,

        ]);*/
        $shop = ShopCart::find($id);
        return view('shopCart.editCart',compact('shop'));


    }
    public function update(Request $request){


        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'photo_car' => 'required',

        ]);



        $infoShop =  ShopCart::find($request->id);
        $infoShop ->id = $request->input('id');
        $infoShop ->user_id = $request->input('user_id');

        if($request->hasFile('photo_car')){
            $images = $request->file('photo_car');
            $imageName =time().'.'.$images->extension();
            $images->move(public_path(),$imageName);
            $infoShop ->photo_car = $imageName;
        }




        $infoShop ->save();

        // return redirect()->back()->with('success',' تم حفظ البيانات بنجاح' );
        return redirect(route('Shop_Cart'))->with('success','تم حفظ البيانات بنجاح' );


    }
    public  function delete(Request $request){

        $id = $request->input('id');
        ShopCart::destroy($id);
        return redirect()->back()->with('success','تم حذف البيانات بنجاح' );
    }
}
