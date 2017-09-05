@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course/{{$course->id}}'>&larr; back to {{$course->name}}</a></p>
      </article>
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href="/admin/course/{{$course->id}}"> {{ $course->name }}</a></h3>
                  <p>{{$course->description}}</p>
         </div>
         <div class="panel-heading">
           <h4>{{$topic->name}}</h4>
           <p>{{$topic->description}}</p>
         </div>
      </div>
      <div class="panel-body">
      <fieldset>
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>Review Status</th>
                        <th>Content</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>
                            <td>{{ $index -> sub_tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                            <td>{{ $index -> review_status}}</td>
                          
                             <td><a class='btn btn-primary' href='/admin/course/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}'>View Content</a></td>
                           <!-- course chnging-->
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                </fieldset>
                </div>
       
    </div>
</div>
@endsection