@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Student</div>

                <div class="panel-body">
                	<ul>
                		<li><a href='/admin/enrollstudent'>Create student enrollment</a></li>
                		<li><a href='/admin/enroll'>Show student enrollment</a></li>
                	</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection