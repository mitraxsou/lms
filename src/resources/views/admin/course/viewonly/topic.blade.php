@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course'>&larr; back to all courses</a></p>
      </article>
      <div class="panel-heading">

                  <h3>{{ $course->name }}</h3>
                  <p>{{$course->description}}</p>
      </div>
      
      <div class="panel-body">
      
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>See Sub-Topics</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>
                            <td>{{ $index -> tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                            <td><a class='btn btn-primary' href='/admin/course/{{$index->course_id}}/{{ $index -> tid }}'>View</a></td> <!--course chnging-->
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