@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <article>
            <p><a href='/adminhome'>&larr; back to Home</a></p>
        </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Course</div>

                <div class="panel-body">
                    <form method="POST" action="/admin/{course}/createtopic" >
                    {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label>Course ID</label>
                            <input type="number" name="cid" value= "{{$course->id}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Topic Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="textarea" name="description" id="description" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="tfile" id="tfile" class="form-control">
                        </div> -->
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