@extends('layouts.app')

@section('content')
	
<div class="container">
	<div class="row">
		<article>
			
        <p><a href='/course/{{$cid->id}}/enroll'>&larr; back to Course</a></p>
      		
      </article>

      <div class="panel panel-default">
      	<div class="panel-heading">
      		<h4>{{$cid->name}}</h4>
      	</div>

      	<div class="panel-body">
      		<div class="row">
      			
      			<form method="POST" action="/course/enroll/{{$cid->id}}">
      				{{ csrf_field() }}
      				<div class="form-group" class="control-label">
      					<input type="text" class="form-control" name="studId" value="{{$user->id}}" readonly>
      				</div>
      				<div class="form-group">
      					<button type="submit" class="btn btn-primary">Submit
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