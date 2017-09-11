@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/owners'>&larr; back to owners</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Role</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/owners/{{$admin->id}}">
                	{{ csrf_field() }}
                    {{ method_field('PATCH') }}
                		<div class="form-group">
                			<label>First Name</label>
                			<input type="text" name="fname" id="name" value="{{$admin->first_name}}" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>First Name</label>
                			<input type="text" name="lname" id="name" value="{{$admin->last_name}}" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Email</label>
                			<input type="email" name="email" value="{{$admin->email}}" id="email" class="form-control">
                		</div>

                		<div><label>Current Roles</label><br/>
                        @if(!empty($role_admin))
                            @foreach($role_admin as $ra)
                                <label class="label label-primary">{{$ra->display_name}}</label>
                            @endforeach
                        @endif
                        @if(count($role_admin)===0)
                            <label class="label label-warning">No roles assigned</label>
                        @endif
                        </div>
                        <div class="form-group">
                            <label>Select Role</label><br/>
                            <select name="role" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" class="form-control">{{$role->display_name}}</option>
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