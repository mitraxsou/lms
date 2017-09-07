@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/mycourse'>&larr; back to MyCourses</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Edit SubTopic details</div>
                @if(count($indexes) >0 )
                	@foreach($indexes as $index)
		                <div class="panel-body">
		                	<form method="POST" action="/admin/course/{{$index->course_id}}/{{$index->tid}}/{{$index->sub_tid}}">
		                	{{ csrf_field() }}
		                    {{ method_field('PATCH') }}
		                		<div class="form-group">
		                			<label>SubTopic Name</label>
		                			<input type="text" name="name" id="name" value="{{$index->name}}" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Description</label>
		                			<input type="text" name="description" id="description" value="{{$index->description}}" class="form-control">
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
		                @endforeach
		            @endif
		                </div>
            </div>
        </div>
    </div>
</div>
@endsection