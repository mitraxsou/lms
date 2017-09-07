@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/mycourse'>&larr; back to my courses</a></p>
      </article>
      <div class="panel-heading">

                  <h3>{{ $course->name }}</h3>
                  <p>{{$course->description}}</p>
      </div>
      <div class="panel panel-heading">
                Index List
                <p><a href="/admin/{{$course->id}}/createtopic">+add more indexes</a></p>
      </div>
      <div class="panel-body">
      
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>See Sub-Topics</th>
                        <th>See Questions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>
                            <td>{{ $index -> tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                            <td><a class='btn btn-primary' href='/admin/mycourse/{{$course->id}}/{{ $index -> tid }}'>View</a></td> <!--course chnging-->
                            <td><a class="btn btn-warning" href="/admin/course/{{$course->id}}/topic/{{$index->tid}}/edit">Edit</a></td>
                            <td><a class="btn btn-default" href="/admin/{{$course->id}}/{{$index->tid}}/quiz">Quiz</a></td>
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                </div>
       
    </div>
</div>
@endsection