<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductContoller extends Controller
{
  public function index(){

 return ProductResource::collection(Product::paginate());

  }
  public function show($id){


      return new ProductResource(Product::find($id));



  }
}
