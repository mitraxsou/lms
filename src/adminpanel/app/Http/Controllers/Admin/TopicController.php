<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $course= Course::find($id);

        return view('admin.course.createtopic', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'tid' => 'required',
            'cid'=> 'required',
            'name' => 'required',
            'description'=>'required',
            ]);
        
        

        DB::table('topic')->insert(['course_id'=>request('cid'),'tid'=>request('tid'),'name'=>request('name'),'description'=>request('description'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
            );

        return redirect('/admin/course/{tid}');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $course = DB::table('topic')->where('tid', $id)->first();
        $indexes = DB::table('subtopics')->where('tid', $id)->get();
        return view('admin.course.subtopic' , compact('course','indexes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
