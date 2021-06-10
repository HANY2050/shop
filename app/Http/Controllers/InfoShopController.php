<?php

namespace App\Http\Controllers;

use App\Models\Info_shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoShopController extends Controller
{
    public function index(){

        $shops = Info_shop::paginate(env('PAGINATION_COUNT'));
        $user = Auth::user()->id;
        return view('shop.show_shop')->with([
            'user'=>$user,
            'shops'=> $shops,

        ]);

    }

    public  function  addShopShow(){

        return view('shop.add_shop');

    }

    public function ShowUpdate($id){

        /*$shops = Info_shop::paginate(env('PAGINATION_COUNT'));
        $user = Auth::user()->id;
        return view('shop.update_shop')->with([
            'user'=>$user,
            'shops'=> $shops,

        ]);*/
        $shop = Info_shop::find($id);
        return view('shop.update_shop',compact('shop'));


    }

    public function DoShowUpdateShop(Request $request){


        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'shop_name' => 'required',
            'owner_name' => 'required',
            'number_phone' => 'required',

            'addresses' => 'required',


        ]);



        $infoShop =  Info_shop::find($request->id);
        $infoShop ->id = $request->input('id');
        $infoShop ->user_id = $request->input('user_id');
        $infoShop ->shop_name = $request->input('shop_name');
        $infoShop ->owner_name = $request->input('owner_name');
        $infoShop ->number_phone = $request->input('number_phone');

        $infoShop ->addresses = $request->input('addresses');
            if($request->hasFile('image_profile')){
        $images = $request->file('image_profile');
        $imageName =time().'.'.$images->extension();
        $images->move(public_path(),$imageName);
        $infoShop ->image_profile = $imageName;
            }




        $infoShop ->save();

       // return redirect()->back()->with('success',' تم حفظ البيانات بنجاح' );
        return redirect(route('Shop'))->with('success','تم حفظ البيانات بنجاح' );


    }

    public function store(Request $request){


        $request->validate([

            'user_id' => 'required',
            'shop_name' => 'required',
            'owner_name' => 'required',
            'number_phone' => 'required',
            'image_profile' => 'required',
            'addresses' => 'required',


        ]);

        $userid = $request->input('user_id');
        $user= Info_shop::where('user_id','=',$userid)->get();
        if(count($user) > 0){

            return redirect(route('Shop'))->with('error','عفوا لا تسطيع الاضافة لقد ادخلت بياناتك من قبل ولذلك عليك ان تدخل في خانة تعديل البيانات !!!!!' );


        }


        $infoShop = new Info_shop();
        $infoShop ->user_id = $request->input('user_id');
        $infoShop ->shop_name = $request->input('shop_name');
        $infoShop ->owner_name = $request->input('owner_name');
        $infoShop ->number_phone = $request->input('number_phone');

        $infoShop ->addresses = $request->input('addresses');

        $images = $request->file('image_profile');
        $imageName =time().'.'.$images->extension();
        $images->move(public_path(),$imageName);
        $infoShop ->image_profile = $imageName;





        $infoShop ->save();

        return redirect(route('Shop'))->with('success',' تم حفظ البيانات بنجاح' );


    }


}
