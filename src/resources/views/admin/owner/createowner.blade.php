@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Owner</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/createowner">
                	{{ csrf_field() }}
                		<div class="form-group">
                			<label>First Name</label>
                			<input type="text" name="fname" id="fname" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Last Name</label>
                			<input type="text" name="lname" id="lname" class="form-control">
                		</div>

                		<div class="form-group">
                			<label>Email</label>
                			<input type="email" name="email" id="email" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Password</label>
                			<input type="text" name="password" class="form-control">
                		</div>
                        <div>
                            <label>Select Roles</label><br/>
                        @foreach($roles as $role)
                            <label for="{{$role->name}}" id="{{$role->id}}">{{$role->display_name}}</label>
                            <input type="checkbox" name="roles[]" value="{{$role->id}}" alt="{{$role->name}}" title="{{$role->name}}"><br/>
                        @endforeach
                		</div>
                        <div class="form-group">
                			<div class="col-md-offset-4 ">
                				 <button type="submit" class="btn btn-primary pull-right">Submit
                                </button>
                                <button type="reset" class="btn btn-warning pull-left">Reset
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