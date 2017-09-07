<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_courses= DB::table('user_course_enroll')->get();

        return view('admin.enroll.enrollview' , compact('user_courses'));
    }
    public function showstudent()
    {
        $users = User::all();
        $courses = Course::all();
        return view('admin.enroll.studentlist' , compact('users', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //dd(request()->all());

        $this->validate(request(),[
            'studentId' => 'required',
            'courseId' => 'required',
        ]);

        $user = User::find(request('studentId'));
        $course = Course::find(request('courseId'));
        //save the assignment
        //check whether relation already exists
        if($user->courses->contains($course))
        {
            return redirect('/admin/enrollstudent')->with('message', 'Can\'t be enrolled .Duplicate Entry !');
        }
        else
        {
            $user->courses()->save($course);

            //the redirect to success
            return redirect('/admin/enroll')->with('message' , 'Enrolled Successfully !');
        }
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
        $user = User::find($id);
        $user_courses = $user->courses()->get();
        //return $user_courses;
       // return $user;
        return view('admin.enroll.enrolldetails' , compact('user_courses', 'user'));
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
    public function destroy($uid , $cid)
    {
        //
        $user = User::find($uid);
        $course = Course::find($cid);
        $user->courses()->detach($course);

        //the redirect to success
        return redirect('/admin/enroll');

    }
}
