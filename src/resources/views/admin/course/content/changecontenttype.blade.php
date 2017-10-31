@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/admin/mycourse/{{$course1->course_id}}'>&larr; back to {{$course1->name}}</a></p>
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
                        <label>Title<i >*</i></label>
                          <input type="text" name="title" class="form-control">
                      
                      
                        <label>Video(Upload .mp4 only,max size - 200MB)</label>
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
@endsection
@section('scripts1')
$(document).ready(function() {
  

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
       });
@endsection
@section('scripts2')
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
@endsection
