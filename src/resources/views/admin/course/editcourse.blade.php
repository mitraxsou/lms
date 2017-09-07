@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/course'>&larr; back to owners</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Course details</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/course/{{$course->id}}">
                	{{ csrf_field() }}
                    {{ method_field('PATCH') }}
                		<div class="form-group">
                			<label>Name</label>
                			<input type="text" name="name" id="name" value="{{$course->name}}" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Description</label>
                			<input type="text" name="description" id="description" value="{{$course->description}}" class="form-control">
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
@endsection