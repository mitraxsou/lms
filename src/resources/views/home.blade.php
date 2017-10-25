@extends('layouts.app')

@section('title', 'Dashboard');

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Hi {{$user->name }}, You are logged in!
                    
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Currently Enrolled in Courses
                        </div>
                        @if(count($cour)>0)
                         @foreach($cour as $co)
                         <div class="panel-body">
                           
                                <span>Course ID : <b>{{ $co->id }}</b></span>
                                
                                <br/>
                                <span>Course Name : <b>{{ $co->name }}</b> 
                                 <a href="course/{{ $co->id }}">Read</a>
                                 @foreach($progress as $prog)
                                    @if($prog->course_id == $co->id)
                                        <p><a class="btn btn-success" href="/course/{{$prog->course_id}}/{{$prog->tid}}/{{$prog->sub_tid}}">Continue</a></p>
                                    @endif
                                 @endforeach
                                </span>
                        </div>
                         @endforeach

                         @else
                         <div class="panel-body">
                         No Courses yet!

                         </div>
                         @endif
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Courses
                        </div>
                        @if(count($index)>0)
                                @foreach($index as $in)
                        
                            
                                <p><a href="/course/{{$in->id}}"> {{$in->name}}</a></p>
                                    
                        @endforeach 
                        @else
                            <div class="panel-body">
                               No Courses yet!

                            </div>
                            @endif

                        </div>
                    </div>

<!-- 
                         @if(count($index)>0)
                           @foreach($index as $co)
                         <div class="panel-body">
                           
                               
                                <span>Course Name : <b>{{ $co->name }}</b> <a href="/studentreg/{{ $co->id }}">Register</a></span>
                           
                        </div>
                         @endforeach 
                            @else
                         <div class="panel-body">
                         No Courses yet!

                         </div>
                         @endif -->

                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection
