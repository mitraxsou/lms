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
        <p><a href='/admin/mycourse/{{$course1->course_id}}/{{$course1->tid}}'>&larr; back to {{$course1->name}}</a></p>
      </article>
        <div class="panel panel-success">
            <div class="panel-heading">
              Choose content type 
            </div>
        </div>
        <div class="panel-body">
              <div class="row">
              <div class="col-sm-8">
                <form method="POST" action="/admin/mycourse/contentAdd/{{$course->content_id}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="form-group">
                       <label>Content ID <i style="color:red;"> *  </i></label>
                       <input type="text" name="contid" value="{{$course->content_id}}" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                     <input type="button" id="other" class="btn btn-default" value="Any Content Other Than Video"></input>
                    <input type="button" id="vdo" class="btn btn-default" value="Video" ></input>
                  </div>

                  <div class="form-group" style="display:none" id="oth">
                    <textarea id="summernote" name="summernote" class="form-control"></textarea>
                  </div>
                  <div class="form-group" style="display: none" id="vd">
                        <label>Title</label>
                          <input type="text" name="title" class="form-control">
                      
                      
                        <label>Video</label>
                          <input type="file" name="video" id="fileUpload" class="form-control">
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

<script>
 $('#vdo').click(function(){
              $('#vd').show();
              $('#oth').hide();
              document.getElementById("vdo").className = "btn btn-primary"
              document.getElementById("other").className = "btn btn-default"
          });

$('#other').click(function(){
            $('#vd').hide();
            $('#oth').show();
            document.getElementById("vdo").className = "btn btn-default"
            document.getElementById("other").className = "btn btn-primary"
         });
</script>
<script type="text/javascript">
    $(document).ready(function() {
 
        $('#summernote').summernote({
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
        });
      });
   
  </script>
</body>
</html>
