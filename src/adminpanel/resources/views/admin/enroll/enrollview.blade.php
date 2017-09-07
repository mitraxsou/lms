@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/enrollmanage'>&larr; back to Enroll</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
        @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
            <div class="panel panel-success">
                <div class="panel-heading">Enrollments's List <span style="float:right;"><a href="/admin/enrollstudent">+ enroll more</a></span></div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>User_ID</th>
                 				<th>Course_ID</th>
                        <th></th>
                        <th>Delete</th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($user_courses as $user_course)
                			<tr>
                  				<td>{{ $user_course -> user_id }}</td>
                  				<td>{{ $user_course -> course_id }}</td>
                          <td><a class='btn btn-primary' href='enroll/{{ $user_course->user_id }}'>View</a></td>
                          <td><a class='btn btn-danger' href='/admin/enroll/delete/{{ $user_course -> user_id }}/{{ $user_course -> course_id }}'>Delete</a></td>
                			</tr>    
                    	@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection