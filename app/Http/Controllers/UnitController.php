<?php

namespace App\Http\Controllers;

use App\Models\Unit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UnitController extends Controller
{
    public function index(){
        $units = Unit::paginate(env('PAGINATION_COUNT'));
        return view('admin.units.units')->with([

            'units'=>$units,
        'showLinks'=>true,
        ]);

    }

    public function search(Request $request){

         $request->validate([
             'unit_search'=>'required'
         ]);

         $searchTerm = $request->input('unit_search');

         $units = Unit::where(

             'unit_name' , 'LIKE' ,'%' . $searchTerm . '%'

         )->orWhere(

             'unit_code' , 'LIKE' ,'%' . $searchTerm . '%'

         )->get();




         if( count ($units) > 0){

            return view('admin.units.units')->with([

                'units' => $units,
                 'showLinks'=>false,

            ]);


         }

        return redirect()->back()->with('error','غير موجود  هذا الاسم   '  );

    }

    public function unitNameExists( $unitName ){
  $unit  = Unit::where(

      'unit_name','=' , $unitName,


  )->first();
  if( $unit){

      return redirect()->back()->with('error','موجود من قبل (   '. $unitName .'   )عفوا هذا الاسم ' );
  }

    }



    public function unitCodeExists( $unitCode ){
        $unit  = Unit::where(

            'unit_code','=' , $unitCode,


        )->first();
        if( $unit){

            return redirect()->back()->with('error','موجود من قبل (   '. $unitCode .'   )عفوا هذا الاسم' );


        }

    }

    public function store(Request $request){
  $request->validate([

     'unit_name'=>'required',
      'unit_code'=>'required',

  ]);

  $unitName = $request->input('unit_name');
  $unitCode = $request->input('unit_code');


  if($this->unitNameExists($unitName)){

      return redirect()->back();

  }
  if($this->unitCodeExists($unitCode)){

      return redirect()->back();

  }

  $unit = new Unit();
        $unit ->unit_name = $request->input('unit_name');
        $unit ->unit_code = $request->input('unit_code');
        $unit ->save();

return redirect()->back()->with('success',' تم حفظ البيانات بنجاح' );

    }

    public function update(Request $request){

        $request->validate([

            'unit_name'=>'required',
            'unit_code'=>'required',
            'unit_id'=>'required',

        ]);






        $unitID= intval($request->input('unit_id'));
        $unit = Unit::find($unitID);

        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        return redirect()->back()->with('success','تم التعديل بنجاح' );
    }

public  function delete(Request $request){

$id = $request->input('unit_id');
Unit::destroy($id);
    return redirect()->back()->with('success','تم حذف البيانات بنجاح' );
}

}
