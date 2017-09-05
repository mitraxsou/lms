<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SubTopicController extends Controller
{
    //
    public function create($id)
    {
         $course = DB::table('topic')->where('tid', $id)->first();
        return view('admin.course.createsubtopic', compact('course'));
    }
    public function contentshow($id)
    {
         $course = DB::table('subtopics')->where('sub_tid', $id)->first();
        return view('admin.course.viewcontent', compact('course'));
    }
       public function store(Request $request)
    {
        //
       
        // $this->validate(request(),[

        //     $rules=[
        //     'ind' => [
        //         'required',
        //         Rule::exists('course_details','index_id')->where(function ($query) use ($course){
        //             $query -> where('course_id', $course); 
        //         }),
        //     ],
        //     'modulename' => 'required',
        //     'description' => 'required',
        //     'url' => 'required'
        //     ],
        // ]);

        $this->validate(request(),[
            'stid' => 'required',
            'tid'=> 'required',
            'cid'=> 'required',
            'name' => 'required',
            'description'=>'required',
            ]);
        if(request('summernote')!="")
        {
            $content=request('summernote');
            $contentType="others";
        }

        else if(request('summernote1')!="")
        {
            $content=request('summernote1');
            $contentType="video";
        }
        else{
            $this->validate(request(),[
            
            'summernote'=>'required',
            ]);
        }
                

        DB::table('subtopics')->insert([
        	'tid'=>request('tid'),
        	'course_id'=>request('cid'),
        	'sub_tid'=>request('stid'),
        	'name'=>request('name'),
        	'description'=>request('description'),
        	//'stfilename'=>request('description'),
        	'content'=>$content,
            'content_type'=>$contentType
        	]);

      
          return redirect('/admin/course/topic/'.request('tid'));
    }
}
