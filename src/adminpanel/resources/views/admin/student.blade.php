@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Student's List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>#</th>
                  				<th>Name</th>
                 				<th>Email</th>
                 				<th></th>
                        <th>Delete</th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($users as $user)
                			<tr>
                  				<td><a href = >{{ $user -> id }} </a></td>
                  				<td>{{ $user -> name }}</td>
                  				<td>{{ $user -> email}}</td>
                  				<td><a class='btn btn-primary' href='student/{{ $user -> id }}'>View</a></td>
                          <td><a class='btn btn-danger' href=''>Delete</a></td>
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