@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/mycourse/{{$indexes->course_id}}'>&larr; back to MyCourses</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Topic details</div>
               
		                <div class="panel-body">
		                	<form method="POST" action="/admin/course/{{$indexes->course_id}}/topic/{{$indexes->tid}}">
		                	{{ csrf_field() }}
		                    {{ method_field('PATCH') }}
		                		<div class="form-group">
		                			<label>Topic Name</label>
		                			<input type="text" name="name" id="name" value="{{$indexes->name}}" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Description</label>
		                			<input type="text" name="description" id="description" value="{{$indexes->description}}" class="form-control">
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
		             		@if (session('success'))
			                        <div class="alert alert-danger">
			                        
			                          {{ session('success') }}
			                          
			                        </div>
			                      @endif
		                </div>
            </div>
        </div>
    </div>
</div>
@endsection