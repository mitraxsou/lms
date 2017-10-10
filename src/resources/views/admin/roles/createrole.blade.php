@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Role</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/createrole">
                	{{ csrf_field() }}
                		<div class="form-group">
                			<label>Name</label>
                			<input type="text" name="name" id="name" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Display Name</label>
                			<input type="text" name="display_name" id="display_name" class="form-control">
                		</div>

                		<div class="form-group">
                			<label>Description</label>
                			<input type="text" name="description" id="description" class="form-control">
                		</div>
                        <div>
                            <label>Select Permissions</label><br/>
                        @foreach($permissions as $perm)
                            <label for="{{$perm->name}}" id="{{$perm->id}}">{{$perm->display_name}}</label>
                            <input type="checkbox" name="permissions[]" value="{{$perm->id}}" alt="{{$perm->name}}" title="{{$perm->name}}"><br/>
                        @endforeach
                		</div>
                        <div class="form-group">
                			 <button type="submit" class="btn btn-primary pull-right">Submit
                                </button>
                                <button type="reset" class="btn btn-warning pull-left">Reset
                                </button>
                            
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