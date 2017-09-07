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
                <div class="col-sm-6">
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

                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Other Courses
                        </div>
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
                         @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection
