@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/owners'>&larr; back to Owners List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
        @if (session('smessage'))
          <div class="alert alert-success">
            {{ session('smessage') }}
          </div>
        @elseif(session('wmessage'))
            <div class="alert alert-danger">
                {{ session('wmessage')}}
            </div>
        @endif
            <div class="panel panel-success">
                <div class="panel-heading">Owner Details
                <div style="float: right;"><a class="btn-sm btn-danger" href="">Delete</a></div>
                </div>

                <div class="panel-body">
                    @if(Auth::guard('admin')->user()->hasRole('super'))
                    <div style="float: right;"><a class="btn btn-warning" href="/admin/owners/{{$admin->id}}/edit">Edit</a></div>
                    @endif
                	<h3>{{ $admin -> first_name }} {{$admin->last_name}}</h3>
                	<h4>{{ $admin -> email }}</h4>
                    <h4>Role</h4>
                    @foreach($admin->roles as $v)
                        <h4 class="label label-success">{{$v->display_name}}</h4>
                    @endforeach
                    <br/>
                    <h4>Categories</h4>
                    @if(count($admin->categories)>0)
                        <p><a href="/admin/owners/assigncategory/edit/{{$admin->id}}">Edit</a></p>
                        @foreach($admin->categories as $cat)
                            <h4 class="label label-default">{{$cat->name}}</h4>
                        @endforeach
                    @else
                        <h5>No categories assigned yet</h5>
                        <p><a href="/admin/owners/assigncategory/{{$admin->id}}"> Assign</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection