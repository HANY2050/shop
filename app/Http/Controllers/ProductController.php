<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    public function index(){

        $products =Product::with(['category','images'])-> paginate(env('PAGINATION_COUNT'));
         $currencyCode = env("CURRENCY_CODE","RY");
        return view('admin.products.products')->with([
            'products'=> $products,
            'currency_code'=> $currencyCode,
        ]);


    }

    public function newProduct ($id = null){

        $product = null;
         if(! is_null($id)){

        $product =Product::with([
           'hasUnit','category', 'images'
        ])-> find($id);

             }

         $unit = Unit::all();
         $categories = Category::all();
        return view('admin.products.new-product')->with([

            'product'=> $product,
            'unit'=> $unit,
            'categories'=>$categories,


        ]);




    }


    public function store(Request $request){
//dd($request);
        $request->validate([
            'user_id'=>'required' ,
            'product_title'=>'required' ,
            'product_description'=>'required' ,
            'product_unit'=>'required' ,
            'product_price'=>'required' ,
            'product_category'=>'required' ,
            'product_discount'=>'required' ,
          'options'=>'required' ,
            'product_total'=>'required'
        ]);


  $product = new Product();

 $this->writeProduct($request,$product);
        return redirect(route('products'))->with('success','تم الادخال بنجاح' );



    }

    private function writeProduct(Request $request ,  Product $product , $update = false ){

        $product->title = $request->input('product_title');

        $product->description = $request->input('product_description');
        $product->unit = intval($request->input('product_unit'));
        $product->price = doubleval($request->input('product_price'));
        $product->total = doubleval($request->input('product_total'));
        $product->category_id = intval($request->input('product_category'));
        $product->user_id = intval($request->input('user_id'));
        $product->discount	 = doubleval($request->input('product_discount'));

        if( $request->has('options') ){

            $optionArray = [];

            $options = array_unique($request->input('options'));

            foreach ($options as $option){

                $optionArray [$option] = [];
                $actualOptions = $request->input($option);

                foreach ($actualOptions as $actualOption){

                    array_push($optionArray [$option],$actualOption);

                }

            }

            $product->options = json_encode($optionArray);

        }



        $product->save();


        if($request->hasFile('product_images') ){

            if($update){
       $images = $product->images;

       if(count($images) > 0){

    foreach ($images as $image ){

        Image::destroy($image->id);

    }


       }


            }

            $images = $request->file('product_images');

            foreach ($images as $image){
                $imageName =time().'.'.$image->extension();
                 $image->move(public_path(),$imageName);
                $image = new Image();
                $image->url=$imageName ;
                $image->product_id = $product->id;
                $image->save();
                //$imageName =time().'.'.$image->extension();
                // $path = $image->move(public_path('images'),$imageName);
                //$image->move(public_path('images'),$imageName);

            }

        }

return $product;

    }


    public function update (Request $request){

        $request->validate([
            'user_id'=>'required' ,
            'product_title'=>'required' ,
            'product_description'=>'required' ,
            'product_unit'=>'required' ,
            'product_price'=>'required' ,
            'product_category'=>'required' ,
            'product_discount'=>'required' ,
            'options'=>'required' ,
            'product_total'=>'required'
        ]);
        $productID= $request->input('product_id');
        $product=Product::find($productID);
        $this->writeProduct($request,$product , true);
        return redirect(route('products'))->with('success','تم التعديل بنجاح' );


    }


    public function search(Request $request){



    }

    public  function delete(Request $request){




    }
         public function deleteOption(Request $request){

             $options = $request->input('options');
             Product::destroy($options);
             return redirect()->back()->with('success','تم حذف البيانات بنجاح' );


         }




}
