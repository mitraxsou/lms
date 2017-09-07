@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course'>&larr; back to All Courses</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Course Details</div>

                <div class="panel-body">
                	<h3>{{ $course -> id }}</h3>
                	<h4>{{ $course -> name }}</h4>
                	<h4>{{ $course-> description }}</h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Course Details</div>
                <div class="panel-body">
                    <table class="table table-striped" data-effect="fade">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Module Name</th>
                                <th>Description</th>
                                <th>URL</th>
                        <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td><a href = >{{ $detail -> index_id }} </a></td>
                                <td>{{ $detail -> module_name }}</td>
                                <td>{{ $detail -> description }}</td>
                                <td><a href='/{{ $detail -> url }}'>{{ $detail->url }}</a></td>
                          <td><a class='btn btn-danger' href=''>Delete</a></td>
                            </tr>    
                        @endforeach
                            <tr>
                                <td><a data-toggle="modal" href="#courseModal">+ Add more</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Modal-->
                    <div id="courseModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Enter Course Details</h4>  
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/admin/createindex">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" name="courseid" value="{{ $course->id }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Index ID</label>
                                            <input type="number" name="index" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Module name</label>
                                            <input type="text" name="modulename" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="description" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" name="url" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-md-offset-4 ">
                                        <button type="submit" class="btn btn-primary">Submit
                                        </button>
                                        </div>
                                    </div>
                                    @if(count($errors))
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach 
                                            </ul>
                                        </div>
                                    @endif
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection