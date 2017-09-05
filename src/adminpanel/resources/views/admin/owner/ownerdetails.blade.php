@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/owners'>&larr; back to Owners List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Owner Details</div>

                <div class="panel-body">
                	<h3>{{ $admin -> first_name }} {{$admin->last_name}}</h3>
                	<h4>{{ $admin -> email }}</h4>
                    @foreach($admin->roles as $v)
                        <h4 class="label label-success">{{$v->display_name}}</h4>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection