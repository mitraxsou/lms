<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course/topic/{{$course1->tid}}'>&larr; back to Topic</a></p>
      </article>
      <!-- <div class="panel panel-success">

      </div> -->
      <div class="panel-group">
      <div class="panel panel-success">
      <div class="panel-heading">
          <div class="row">
              
              <div class="col-sm-8"><h3>{{ $course1->name }}</h3>
               <p><b>Description :</b> {{$course1->description}}</p></div>
          </div>
                  
                 
         </div>
      <div class="panel-body">
      <fieldset>

     @if($course->content_type!="video")
        <form method="POST" action="/admin/editsubtopicmaking/{{$course1->content_id}}" >
          {{ csrf_field() }}
            <input type="hidden" name="tid" value= "{{$course1->tid}}" class="form-control" readonly>
            <input type="hidden" name="course_id" value= "{{$course1->course_id}}" class="form-control">
            <input type="hidden" name="sub_tid" value= "{{$course1->sub_tid}}" class="form-control" >
            <input type="hidden" name="content_id" value= "{{$course1->content_id}}" class="form-control" >
            <div class="form-group">
              <label>Chapter Name  <i style="color:red;"> * </i></label>
              <input type="name" name="description" id="description" value="{!!$course1->name!!}" class="form-control" readonly="" /> 
            </div>
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
      @else
        <div class="" style="position: center">
        @if($course->content!="")
          <video src="{{$video}}">
          
          </video>
        </div>
        <div class="">
          <h4>Replace this video ?</h4>
          <a href="/admin/vidremove/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}" class="btn btn-danger">Yes</a>
          <a href="/admin/mycourse/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}" class="btn btn-success">No</a>
        @else
          <h4>Add video </h4>
          <a href="/admin/mycourse/contentselection/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}" class="btn btn-primary">Upload video</a>
          <br>
          <h4> Add content</h4>
          <a href="/admin/mycourse/contentselection/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}" class="btn btn-primary">Upload text</a>
        @endif
        </div>
      @endif

<script type="text/javascript">
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
</script>


      </fieldset>
      </div>
       </div>
       </div>
    </div>
</div>
</body>
</html>