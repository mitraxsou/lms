@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/roles'>&larr; back to Roles</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Role</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/roles/{{$role->id}}">
                	{{ csrf_field() }}
                    {{ method_field('PATCH') }}
                		<div class="form-group">
                			<label>Name</label>
                			<input type="text" name="name" id="name" value="{{$role->name}}" class="form-control">
                		</div>
                		<div class="form-group">
                			<label>Display Name</label>
                			<input type="text" name="display_name" value="{{$role->display_name}}" id="display_name" class="form-control">
                		</div>

                		<div class="form-group">
                			<label>Description</label>
                			<input type="text" name="description" value="{{$role->description}}" id="description" class="form-control">
                		</div>
                        <div><label>Current roles</label><br/>
                        @if(!empty($role_permission))
                            @foreach($role_permission as $rp)
                                <label class="label label-primary">{{$rp->display_name}}</label>
                            @endforeach
                        @endif
                        @if(count($role_permission)===0)
                            <label class="label label-warning">No permissions yet</label>
                        @endif
                        </div>
                        <div>
                            <label>Select Permissions</label><br/>
                            <ul>
                        @foreach($permission as $perm)
                            <li>{{$perm->display_name}}
                            <input type="checkbox" name="permissions[]" value="{{$perm->id}}" alt="{{$perm->name}}" title="{{$perm->name}}"></li>
                        @endforeach
                            </ul>
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