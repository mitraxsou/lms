@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Admin's Dashboard</div>

                <div class="panel-body">
                    Admin Home
                </div>

            </div>
            <div class = "row">
                <div class="col-sm-4">
                    <div class="panel panel-success">
                    <div class="panel-heading">Owners</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/owners">Show all Owners</a></li>
                                <li><a href="/admin/createowner">Create Owners</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-success">
                    <div class="panel-heading">Student &amp; Enrollments</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/student">Show all Students</a></li>
                                <li><a href="/admin/createstudent">Create Students</a></li>
                                <li><a href="/admin/enrollmanage">enroll students</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-success">
                    <div class="panel-heading">Course </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/createcourse">Create Course</a></li>
                                <li><a href="/admin/course">Show all Courses</a></li>
                                <li><a href="/admin/course">Edit Course</a></li>
                                <li><a href="/admin/categories">Categories</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection