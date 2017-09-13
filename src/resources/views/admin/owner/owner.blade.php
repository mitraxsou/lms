@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
        @if (session('message'))
          <div class="alert alert-warning">
            {{ session('message') }}
          </div>
        @endif
            <div class="panel panel-success">
                <div class="panel-heading">Owners List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>#</th>
                  				<th>FName</th>
                  				<th>LName</th>
                 				<th>Email</th>
                        <th>Roles</th>
                 				<th></th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($admins as $admin)
                			<tr>
                  				<td><a href = >{{ $admin -> id }} </a></td>
                  				<td>{{ $admin -> first_name }}</td>
                  				<td>{{ $admin -> last_name }}</td>
                  				<td>{{ $admin -> email}}</td>
                          <td>
                            @if(!empty($admin->roles))
                              @foreach($admin->roles as $v)
                                <label class="label label-success">{{$v->display_name}}</label>
                              @endforeach
                            @endif
                          </td>
                  				<td><a class='btn btn-primary' href='owners/{{ $admin -> id }}'>View</a></td>
                			</tr>    
                    	@endforeach
                    	</tbody>
                    </table>
                    {!! $admins->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection