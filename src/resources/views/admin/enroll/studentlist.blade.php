@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/enrollmanage'>&larr; back to Enroll</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
        @if (session('message'))
          <div class="alert alert-warning">
            {{ session('message') }}
          </div>
        @endif
            <div class="panel panel-success">
                <div class="panel-heading">Student's List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>#</th>
                  				<th>Name</th>
                 				<th>Email</th>
                 				<th></th>
                        <th>Delete</th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($users as $user)
                			<tr>
                  				<td><a href = >{{ $user -> id }} </a></td>
                  				<td>{{ $user -> name }}</td>
                  				<td>{{ $user -> email}}</td>
                  				<td><a class="btn btn-primary call" data-toggle="modal"  data-target="#enrollModal" data-id="{{ $user-> id }}">Select course</a></td>
                          <td><a class='btn btn-danger' href=''>Delete</a></td>

                			</tr>    
                    	@endforeach
                    	</tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div id="enrollModal" class="modal fade" role="dialog" tabindex="-1">
                	<div class="modal-dialog" role="document">
                		
                		<div class="modal-content">
                			<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    			<h4 class="modal-title">Select any course</h4>
                			</div>
                			<div class="modal-body">
                			<form method="POST" action='/admin/enroll'>
                				{{ csrf_field() }}
                				<div class="form-group" class="control-label">
                						<label>Student Name</label>
                						<input type="text" class="form-control" name="studentId" id="studentId" readonly>
                				</div>
                				<div class="form-group" class="control-label">
                						<label for="coursetype">Select course</label>
								            <select name= "courseId" class="form-control">
								              @foreach ($courses as $course)
								            	<option name="coursename" value=" {{ $course-> id }} ">{{ $course-> name }}</option>
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
                <!-- End model -->
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
        	$(".call").click(function(){ // Click to only happen on announce links
           		$('#studentId').val($(this).data('id'));
           		$('#enrollModal').modal('show');      		
            });
       });
    </script>
@endsection