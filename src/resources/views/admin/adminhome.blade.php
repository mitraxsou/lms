@extends('admin.layouts')

@section('content')
@inject('countera','App\Counter')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Admin's Dashboard</div>

                <div class="panel-body">
                    Admin Home
                </div>

            </div>
            <div class = "row">
            @if(Auth::guard('admin')->user()->hasRole('super'))
                <div class="col-sm-6">
                    <div class="panel panel-success">
                    <div class="panel-heading">Owners</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/owners">Show all Owners</a></li>
                                @if(Auth::guard('admin')->user()->hasRole('super'))
                                <!-- <li><a href="/admin/createowner">Create Owners 1</a></li> -->
                                <li><a href="/admin/createowner/multi">Create Owners (new)</a></li>
                                <li><a href="/admin/recreate">Recreate owners
                                 @if($countera->lessonreassign()>0)
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
                                    ">{{$countera->lessonreassign()}}</span>
                                 @endif
                                </a></li>
                                <li><a href="/admin/roles">Manage Roles</a></li>
                                @endif
                            </ul>
                        </div>    
                    </div>
                </div>
            @endif
                
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
                            @if(Auth::guard('admin')->user()->hasRole('review admin'))
                                <li><a href="/admin/publishcourse">Publish Course
                                @if($countera->lessonSuperPublish()>0)
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
                                    ">{{$countera->lessonSuperPublish()}}</span>
                                 @endif

                                </a></li>
                                @endif
                                @if(Auth::guard('admin')->user()->hasRole('super'))
                                <li><a href="/admin/publishlist">Publish List
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
                                
                                <li><a href="/admin/mycourse">My Courses
                                @if($countera->mycourse()>0)
                                <img src="bell1.gif" width="19px" height="17px"></span>
                                 @endif
                             </a></li>
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
                                  <li><a href="/admin/reviewdeletionrequest">Requests for Deletion
                                 @if($countera->del()>0)
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
                                    ">{{$countera->del()}}</span>
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