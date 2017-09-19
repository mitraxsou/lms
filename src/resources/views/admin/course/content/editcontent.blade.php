@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/admin/mycourse/{{$course1->course_id}}'>&larr; back to Topic</a></p>
      </article>
      <!-- <div class="panel panel-success">

      </div> -->
      <div class="panel-group">
      <div class="panel panel-success">
      <div class="panel-heading">
          <div class="row">
              
              <div class="col-sm-8"><h3>{{ $course1->name }}</h3>
               <p><b>Description :</b> {{$course1->description}}</p></div>
               <!-- -->
          </div>       
         </div>
         <p>{{$course->content_type}}</p>
                      <label>Feedback  <i style="color:red;"> * </i></label>
                      <textarea name="description" id="description" class="form-control" readonly="" > 
                      {!!$course->feedback!!}
                      </textarea>
      @if($course->content_type!="video")
      <fieldset>
        <form method="POST" action="/admin/editsubtopic/{{$course1->content_id}}" >
                  {{ csrf_field() }}
                    <input type="hidden" name="tid" value= "{{$course1->tid}}" class="form-control" readonly>
                     <input type="hidden" name="course_id" value= "{{$course1->course_id}}" class="form-control">
                      <input type="hidden" name="sub_tid" value= "{{$course1->sub_tid}}" class="form-control" >
                       <input type="hidden" name="content_id" value= "{{$course1->content_id}}" class="form-control" >
                    <div class="form-group">
                      <label>Contents  <i style="color:red;"> * </i></label>
                      <textarea name="descriptionsummer" id="descriptionsummer" class="form-control" > {!!$course->content!!}
                      </textarea>
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
      </fieldset>
      @else
      <div>
        <video width="360" height="240" controls >
          <source src="{{$video}}" type="" >
        </video>

        <br>
        <a href="/admin/mycourse/contentdelete/{{$course1->content_id}}" class="btn btn-danger">Remove video</a>
      </div>
      @endif
      @if($course->content_type=="")
         <a href="/admin/mycourse/contentselection/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}" class="btn btn-primary">Add Content</a>
      @endif
      </div>
       </div>
       </div>
    </div>
</div>
@endsection

@section('scripts1')
 $(document).ready(function() {
 
        $('#descriptionsummer').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", [ "paragraph"]],
                //["table", ["table"]],
                ["insert", ["link", "picture"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
         height: 300,
         placeholder: 'You can provide image / text / link type of contents here.'

      /*  height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null, 
        placeholder: 'You can provide image/video/text/link contents here.',            
        focus: true,
        fontNames:['Arial','Arial Black']*/
    });
      });
@endsection