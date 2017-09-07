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
                            <div class="panel-body">
                            @foreach($cour as $co)
                                <p>{{ $co->id }}</p>
                                <br/>

                                <a href="course/{{ $co->id }}">{{ $co->name }}</a>
                            @endforeach 
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Batches
                        </div>
                            <div class="panel-body">

                            @foreach($user->batches as $batch)
                                <p>{{ $batch->pivot->batch_id}}</p>
                            @endforeach
                            
                            <br/>
                            @if (count($user->batches) > 0)
                                <p>{{ $bat->name }}</p>
                            @else
                                <p>No batch assigned</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection
