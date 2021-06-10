<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){

 return CountryResource::collection(Country::paginate());


    }

    public function showState($id){
 $country = Country::find($id);
  return StateResource::collection($country->states()->paginate());

    }
  public function showCities($id){
      $country = Country::find($id);

      return CityResource::collection($country->cities()->paginate());

  }

}
