@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/roles'>&larr; back to Roles List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Role Details </div>

                <div class="panel-body">
                    <div style="float: right;"><a class="btn btn-warning" href="/admin/roles/{{$role->id}}/edit">Edit</a></div>
                	<h3>{{ $role -> name }} </h3>
                	<h3>{{$role->display_name}}</h3>
                	<h4>{{ $role -> description }}</h4>
                    @foreach($role->permissions as $v)
                        <h4 class="label label-success">{{$v->display_name}}</h4>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection