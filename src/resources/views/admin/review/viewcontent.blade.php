@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/admin/review/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}/{{$course1 -> content_id}}'>&larr; back to course</a></p>
      </article>
     
       <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>Content</h3>
                    

                </div>

                <div class="panel-body">
                
                  <div class="form-group">
                      <label>Content </label>
                     <span> {!! $course -> content!!}</span>
                    </div>
                      
                        
                   
                   
                   
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection