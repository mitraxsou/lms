@extends('admin.layouts')

@section('content')
@inject('countera','App\Counter')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Admin's Dashboard</div>

                <div class="panel-body">
                    Admin Home
                </div>

            </div>
            <div class = "row">
                <div class="col-sm-6">
                    <div class="panel panel-success">
                    <div class="panel-heading">Owners</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/owners">Show all Owners</a></li>
                                @if(Auth::guard('admin')->user()->hasRole('super'))
                                <li><a href="/admin/createowner">Create Owners</a></li>
                                
                                <li><a href="/admin/roles">Manage Roles</a></li>
                                @endif
                            </ul>
                        </div>    
                    </div>
                </div>
                
                <!-- <div class="col-sm-4">
                    <div class="panel panel-success">
                    <div class="panel-heading">Student &amp; Enrollments</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/student">Show all Students</a></li>
                                <li><a href="/admin/createstudent">Create Students</a></li>
                                <li><a href="/admin/enrollmanage">enroll students</a></li>
                            </ul>
                        </div>    
                    </div>
                </div> -->
                <div class="col-sm-6">
                    <div class="panel panel-success">
                    <div class="panel-heading">Course </div>
                        <div class="panel-body">
                            <ul>
                            @if(Auth::guard('admin')->user()->hasRole('super'))
                                <li><a href="/admin/publishcourse">Publish Course
                                @if($countera->lessonPublish()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonPublish()}}</span>
                                 @endif
                                </a></li>
                                <li><a href="/admin/course">Show all Courses</a></li>
                            @endif
                                @if(Auth::guard('admin')->user()->hasRole('course admin'))
                                <li><a href="/admin/createcourse">Create Course</a></li>
                                @endif
                                
                                <li><a href="/admin/mycourse">My Courses</a></li>
                                <li><a href="/admin/categories">Categories</a></li>
                                  @if(Auth::guard('admin')->user()->hasRole('review admin'))
                                  
                                <li><a href="/admin/reviewcourse">Review Content
                                 @if($countera->lesson()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lesson()}}</span>
                                @endif
                                </a></li>
                                <li><a href="/admin/reviewstr">Review Structure
                                 @if($countera->lessonstr()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonstr()}}</span>
                                @endif
                                </a></li>
                                @endif
                            </ul>
                        </div>    
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection