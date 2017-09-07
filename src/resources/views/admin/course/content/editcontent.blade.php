<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link rel="stylesheet" href="sass/sweetalert.css">
    <!-- CSRF Token -->
  
    <script src="js/sweetalert.min.js"></script>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.min.js"></script>
</head>
<body>
@include('sweet::alert')

<div class="container">
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
      <div class="panel-body">
      <fieldset>
     
     
        <form method="POST" action="/admin/editsubtopic/{{$course1->content_id}}" >
                  {{ csrf_field() }}
                    <input type="hidden" name="tid" value= "{{$course1->tid}}" class="form-control" readonly>
                     <input type="hidden" name="course_id" value= "{{$course1->course_id}}" class="form-control">
                      <input type="hidden" name="sub_tid" value= "{{$course1->sub_tid}}" class="form-control" >
                       <input type="hidden" name="content_id" value= "{{$course1->content_id}}" class="form-control" >
                    <div class="form-group">
                      <label>Feedback  <i style="color:red;"> * </i></label>
                      <textarea name="description" id="description" class="form-control" readonly="" > 
                      {!!$course->feedback!!}
                      </textarea>
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