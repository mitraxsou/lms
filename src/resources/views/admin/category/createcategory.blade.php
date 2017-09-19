@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Category</div>

                <div class="panel-body">
                	<form method="POST" action='/admin/storeCategory'>
                	{{ csrf_field() }}
                		<div class="form-group">
                			<label>Category Name</label>
                			<input type="text" name="name" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Description</label>
                			<input type="text" name="desc" class="form-control" >
                		</div>
                		<div class="form-group">
                			<label>Parent Category ID</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">No parent</option>
                                @foreach($pcategories as $pcat)
                                    <option value="{{$pcat->id}}">{{$pcat->name}}</option>
                                @endforeach
                            </select>
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