@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Roles List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>#</th>
                  				<th>Name</th>
                  				<th>DisplayName</th>
                 				<th>description</th>
                        <th>Permissions</th>
                 				<th></th>
                        <th>Delete</th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($roles as $role)
                			<tr>
                  				<td><a href = >{{ $role -> id }} </a></td>
                  				<td>{{ $role -> name }}</td>
                  				<td>{{ $role -> display_name }}</td>
                  				<td>{{ $role -> description}}</td>
                          <td>
                            @if(!empty($role->permissions))
                              @foreach($role->permissions as $v)
                                <label class="label label-success">{{$v->display_name}}</label>
                              @endforeach
                            @endif
                          </td>
                  				<td><a class='btn btn-primary' href='roles/{{ $role -> id }}'>View</a></td>
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