@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/course/{{$course->id}}'>&larr; back to Course</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>{{ $course ->name }}</h3>
                    <p>{{$course->description}}</p>
                </div>

                <div class="panel-body">
                	<form method="POST" action="/admin/{{$course->id}}/createtopic" enctype="multipart/form-data">
                	{{ csrf_field() }}
                		<div class="form-group">
                			<label>Topic ID</label>
                			<input type="number" name="topicid" class="form-control">
                		</div>
                        <div class="form-group">
                            <input type="hidden" name="cid" value="{{$course->id}}">
                        </div>
                		<div class="form-group">
                			<label>Topic Name</label>
                			<input type="text" name="name" id="name" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Topic Description</label>
                			<input type="textarea" name="description" id="description" class="form-control">
                		</div>
                        <!-- <div class="form-group">
                            <label>Index Image</label>
                            <input type="file" name="cfile" class="form-control">
                        </div> -->
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
@endsection