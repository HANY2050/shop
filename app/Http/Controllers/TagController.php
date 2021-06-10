<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(){

  $tags = Tag::paginate(env('PAGINATION_COUNT'));
  return view('admin.tags.tags')->with([
      'tags'=>$tags,
      'showLinks'=>true,

  ]);



    }


    public function store(Request $request){

        $request->validate([

            'tag_name' => 'required'

        ]);
        $tagName= $request->input('tag_name');
        $tag= Tag::where('tag','=',$tagName)->get();
        if(count($tag) > 0){

            return redirect()->back()->with('error','موجود من قبل (   '.  $tagName .'   )عفوا هذا الاسم' );


        }

        $newTag = new Tag();
        $newTag ->tag = $tagName;

        $newTag ->save();

        return redirect()->back()->with('success',' بنجاح  (   '. $tag .'   )تم ادخال ' );



    }

    public function search(Request $request){

        $request->validate([
            'tag_search'=>'required'
        ]);

        $searchTerm = $request->input('tag_search');

        $tags = Tag::where(

            'tag' , 'LIKE' ,'%' . $searchTerm . '%'

        )->get();




        if( count ($tags) > 0){

            return view('admin.tags.tags')->with([

                'tags' => $tags,
                'showLinks'=>false,

            ]);


        }

        return redirect()->back()->with('error','غير موجود  هذا الاسم   '  );

    }

    public function update(Request $request){

        $request->validate([

            'tag_name'=>'required',

            'tag_id'=>'required',

        ]);
dd($request);
        $tagName= $request->input('tag_name');
        $tag= Tag::where('tag','=',$tagName)->get();
        if(count($tag) > 0){

            return redirect()->back()->with('error','موجود من قبل (   '. $tagName .'   )عفوا هذا الاسم' );


        }

        $tagID= intval($request->input('tag_id'));
        $tag = Tag::find($tagID);

        $tag->tag = $request->input('tag_name');
        $tag->save();
        return redirect()->back()->with('success','تم التعديل بنجاح' );
    }


    public  function delete(Request $request){
        $id = $request->input('tag_id');
        Tag::destroy($id);
        return redirect()->back()->with('success','تم حذف البيانات بنجاح' );



    }
}
