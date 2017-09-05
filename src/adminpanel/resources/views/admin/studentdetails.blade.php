@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/student'>&larr; back to Student List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Student's List</div>

                <div class="panel-body">
                	<h3>{{ $user -> name }}</h3>
                	<h4>{{ $user -> email }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection