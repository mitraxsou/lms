@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/categories'>&larr; back to Category List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Category Details</div>

                <div class="panel-body">
                    @if(Auth::guard('admin')->user()->hasRole('super'))
                    <div style="float: right;"><a class="btn btn-warning" href="/admin/category/{{$cat->id}}/edit">Edit</a></div>
                    @endif
                	<h3>{{ $cat -> id }}</h3>
                	<h4>{{ $cat -> name }}</h4>
                    <h4>{{$cat->description}}</h4>
                    <h4>{{$cat->parent_id}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection