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
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Currently Enrolled in Courses
                        </div>
                            
                    </div>
                </div>

            </div>
        </div>   
    </div>
</div>
@endsection
