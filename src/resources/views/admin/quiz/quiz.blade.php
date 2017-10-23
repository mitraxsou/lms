@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/mycourse/{{$course->id}}'>&larr; back to {{$course->name}}</a></p>
      </article>
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href='/admin/mycourse/{{$course->id}}'> {{ $course->name }}</a></h3>
                  <p>{{$course->description}}</p>
         </div>
         <div class="panel-body">
              <h4>{{$topic->name}}</h4>
              <p>{{$topic->description}}</p>
            
         </div>
      </div>
      <div class="panel panel-default">
       <div class="panel-heading">
                    <h3> Quiz List for every index</h3>
        </div>
               
                
      </div>
      <div class="panel-body">
      <fieldset>
        <table class="table table-striped" data-effect="fade">
          <thead>
            <tr>
              <th>ID</th>
              <th>Subtopic</th>
              <th>Quiz</th>
            </tr>
          </thead>
          <tbody>
          @if(count($subtopics)>0)
            @foreach($subtopics as $subtopic)
              <tr>
                <td>{{$subtopic->sub_tid}}</td>
                <td>{{$subtopic->name}}</td>
                <td><a class="btn btn-default" href="/admin/{{$subtopic->course_id}}/{{$subtopic->tid}}/{{$subtopic->sub_tid}}/showquiz">Quiz</a></td>
              </tr>
            @endforeach
          @else
          <p>No Subtopics yet</p>
          @endif

          </tbody>
        </table>
      </fieldset>
                </div>
       
    </div>
</div>
@endsection