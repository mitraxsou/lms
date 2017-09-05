@extends('layouts.app')



@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
                      @include('sweet::alert')
                        
    <div class="row">
        <article>
            <p><a href='/adminhome'>&larr; back to Home</a></p>
        </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Registration</div>

                <div class="panel-body">
                    <form method="POST" action="/coursereg" >
                	{{ csrf_field() }}
                	
                       <div class="form-group">
                            <label>Course ID </label>
                            <input type="number" name="cid" value= "{{$course->id}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" name="cname" value= "{{$course->name}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Your ID</label>
                            <input type="number" name="sid" value= "{{$student->id}}" class="form-control" readonly>
                        </div>
                		<div class="form-group">
                			<label>Your Name  <i style="color:red;"> * </i></label>
                			<input type="text" name="name" id="name"  value= "{{$student->name}}" class="form-control" readonly>
                		</div>
                		
                        

                        
                		<div class="form-group">
                        

                				<button type="submit" class="btn btn-primary pull-right">Submit</button>
                			
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

</div>
@endsection