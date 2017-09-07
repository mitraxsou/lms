@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/enroll'>&larr; back to All Student Enrollment</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Name : {{ $user -> name }} | ID : {{ $user -> email }} is Enrolled in</div>
                @foreach($user_courses as $user_course)
                <div class="panel-body">
                    <h3>Course Id</h3>
                	<h3>{{ $user_course -> id }}</h3>
                	<h4>{{ $user_course -> name }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection