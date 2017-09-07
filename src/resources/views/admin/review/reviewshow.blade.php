@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to course</a></p>
      </article>
      <div class="panel panel-success">
      <div class="panel-heading">
                Review List

      </div>
      <div class="panel-body">
      <fieldset>
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Topic</th> 
                           <th>Name </th>
                          <th>Description</th>
                        <th>View Content</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($course1) >0 )
                        @foreach ($course1 as $course)
                        <tr>
                            <td>{{ $course -> sub_tid}}</td>
                            <td>{{ $course -> tid}}</td>
                            <td>{{ $course -> name }}</td>
                            <td>{{ $course -> description }}</td>
                             <td><a class='btn btn-primary' href='/admin/review/{{ $course -> sub_tid}}/{{ $course -> content_id }}'>View Flow</a></td>
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
</div>
@endsection