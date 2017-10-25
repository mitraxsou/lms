@extends('layouts.app')

@section('content')

<div class="container">
 
                         
  <div class="row">
    <article>
        <p><a href='/course/{{$course->id}}'>&larr; back to Course</a></p>
      </article>
                                               
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href='/course/{{$course->id}}/{{$topic->tid}}'> {{ $topic->name }}</a></h3>
                  <p>{{$topic->description}}</p>
         </div>
         
      </div> 
      <div class="panel-body">
        @foreach($subtopic as $sub)
          <div class="row">
            <div class="col-sm-12">
              <h4><a href="/course/{{$sub->course_id}}/{{$sub->tid}}/{{$sub->sub_tid}}">{{$sub->name}}</a></h4>
              <p>{{$sub->description}}</p>
              <hr>
            </div>
            
          </div>
        @endforeach
    </div>
  </div>
</div>
@endsection