@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Course List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th></th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($courses as $course)
                			<tr>
                  				<td>{{ $course -> id }}</td>
                  				<td>{{ $course -> name }}</td>
                  				<td>{{ $course -> description}}</td>
                          <td><img src = "<?php echo $course->cfilename ?>" height="50px" width="50px"></img></td>
                          <td><a class='btn btn-primary' href='course/{{ $course -> id }}'>View</a></td>
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