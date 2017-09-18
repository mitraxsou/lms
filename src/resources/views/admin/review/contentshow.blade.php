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
      <!-- 
      <div class="panel-body">
      <fieldset>
           {!! $course1 -> content!!}
                 
      </fieldset>
      </div> -->
       <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>Content</h3>
                    

                </div>

                <div class="panel-body">
                 @if(count($errors))
                                <div class="alert alert-danger">
                                   <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach 
                                    </ul>
                                </div>
                            @endif
                  <form method="POST" action="/admin/reviewcorrect/{{$course1 ->content_id}}" >
                  {{ csrf_field() }}
                  <div class="form-group">
                      <label>Content </label>
                      @if($course1->content_type=="video")
                        <video controls >
                          <source src="{{$video}}" type="" >
                        </video>
                      @else
                        {!!$course1->content!!}
                      @endif
                    </div>
                      
                        
                    <div class="form-group" id="feedback">
                        

                        <button type="submit" name="Correct" class="btn btn-success pull-right">Good to Go</button>
                           <input type="button" name="Correct" class="btn btn-danger pull-left" value="Edit required" onclick="editshow()">
                    </div>
                  </form>
                   <div class="form-group" id="edit" style="display:none;">
                    <form method="POST" action="/admin/reviewfeedback/{{$course1 ->content_id}}" >
                       {{ csrf_field() }}
                      <label>Corrections <i style="color:red;"> *  </i></label>
                      <textarea name="feedback" class="form-control" placeholder="Write Corrections required here"></textarea>
                      <input type="hidden" name="content_id" value="{{$course1 ->content_id}}" class="form-control"><br>
                      <div class="form-group">
                       <button type="submit" name="Correct" class="btn btn-primary pull-right">Verify</button>
                       </div>
                      </form>

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      function editshow(){
         // document.getElementById("edit").style.display="block";
          document.getElementById("feedback").style.display="none";
          $("#edit").slideDown();
      }
    </script>
</div>
@endsection