@extends('admin.layouts')

@section('content')
<div class="container">
  <div class="row">
    	<article>
    		<p><a href='/admin/mycourse/{{$topic->course_id}}'>&larr; back to Course</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>Course : {{ $course ->name }}</h3>

                
                        <h4>Topic : {{$topic->name}}</h4>
                   
                </div>
            
                    <div class="panel-body">
                    	<form method="POST" id="videoUpload" action="/admin/{{$topic->course_id}}/{{$topic->tid}}/createsubtopic" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    		
                           <div class="form-group">
                                <label>Topic ID </label>
                                <input type="number" name="tid" value= "{{$topic->tid}}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Course ID</label>
                                <input type="number" name="cid" value= "{{$topic->course_id}}" class="form-control" readonly>
                            </div>
                    		<div class="form-group">
                    			<label>Chapter Name  <i style="color:red;"> * </i></label>
                    			<input type="text" name="name" id="name" class="form-control">
                    		</div>
                    		<div class="form-group">
                    			<label>Chapter Description  <i style="color:red;"> * </i></label>
                    			<input type="textarea" name="description" id="description" class="form-control">
                    		</div>
                           
                            <div class="form-group">
                                <!-- <label>Select Content Type</label>
                               <select name="type">
                                     <option value="vdo">Video</option>
                                     <option value="othr">Other</option>
                                     <option value="2" selected="selected">Select</option>
                                </select> -->
                                <label>Select Content Type <i style="color:red;"> * </i></label>
                                <input type="button" id="other" class="btn btn-default" value="Any Content Other Than Video"></input>
                                <input type="button" id="vdo" class="btn btn-default" value="Video" ></input>
                                
                            </div>
                          
                            <div class="form-group" style="display: none" id="oth">
                                    
                                    <textarea id="summernote" name="summernote"  ></textarea>
                                   
                            </div>
                             <div class="form-group" style="display: none" id="vd">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Video</label>
                                    <input type="file" name="video" id="fileUpload" class="form-control">
                                 </div>
                             </div>

                            
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

      /*  height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null, 
        placeholder: 'You can provide image/video/text/link contents here.',            
        focus: true,
        fontNames:['Arial','Arial Black']*/
    });
         $('#summernote1').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["paragraph"]],
                //["table", ["table"]],
                ["insert", ["video"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
         height: 300,
        placeholder: 'You can provide video type of contents here.'

      /*  height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null, 
        placeholder: 'You can provide image/video/text/link contents here.',            
        focus: true,
        fontNames:['Arial','Arial Black']*/
    });


    });
@endsection