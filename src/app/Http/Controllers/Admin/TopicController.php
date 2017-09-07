<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

        return view('admin.course.topic.createtopic', compact('course'));
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
        $cid = request('cid');
        

        DB::table('topic')->insert(['course_id'=>request('cid'),'tid'=>request('tid'),'name'=>request('name'),'description'=>request('description'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
            );
    alert()->success('Successful!!
        You will find the topic in this list.')->persistent("Close this");
       return redirect('/admin/mycourse/'.$cid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $html='';
        $cid=request('course_id');
        $tid= request('tid');//$_GET['tid'];
        $course = Course::find($cid);
        $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        $indexes = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid]])->orderBy('sub_tid')->get();
        
        foreach ($indexes as $index)
        {
                        
                        $html=$html.
                              '<tr>
                                 <td>' .  $index -> sub_tid . '</td>' .
                                 '<td>' . $index -> name . '</td>' .
                                 '<td>' . $index -> description . '</td>' .
                                  '<td>' . $index -> review_status . '</td>' .

                              '</tr>';
         //dd($htiml);                
         }               

        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cid,$tid)
    {
        $indexes = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        //dd($indexes);
        return view('admin.course.topic.edittopic',compact('indexes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cid,$tid)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ]);


         DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->update(['name'=>request('name'),'description'=>request('description'),'updated_at'=>Carbon::now()]);
        alert()->success('Updated Successfully');
        return redirect('/admin/mycourse/'.$tid)->with('success','Topic updated successfully.');
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
