@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Student</div>

                <div class="panel-body">
                	<ul>
                		<li><a data-toggle="modal" href="#createModal">Create single student</a></li>
                        <li><a  href="">Create multiple student</a></li>
                	</ul>
                </div>
                <!-- Modal -->
                <div id="createModal" class="modal fade" role="dialog">
                	<div class="modal-dialog">
                		
                		<div class="modal-content">
                			<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    			<h4 class="modal-title">Enter Student Details</h4>
                			</div>
                			<div class="modal-body">
                				<form method="POST" action='/admin/student'>
                					{{ csrf_field() }}
                					<div class="form-group">
                						<label>Email/username</label>
                						<input type="email" name="email" class="form-control">
                					</div>
                					<div class="form-group">
                						<label>Full Name</label>
                						<input type="text" name="name" class="form-control" >
                					</div>
                					<div class="form-group">
                						<label>Password</label>
                						<input type="text" name="password" class="form-control" >
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
                <!-- End model -->
            </div>
        </div>
    </div>
</div>
@endsection