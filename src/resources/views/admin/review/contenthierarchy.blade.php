@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 
<div class="container">
      @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/admin/reviewcourse'>&larr; back to my courses</a></p>
      </article>
     
     
    <div class="row">
      <div class="col-md-8 ">
       <div class="panel panel-success">
              <div class="panel-heading">
                       <label> {{$course->name}} </label>
                        

              </div>
              <div class="panel-body">
             {!!$course->fixedstructure!!}
              </div>
        </div>
      </div>
      <div  class="col-md-4">
       <div class="panel panel-success">
       <div class="panel-heading">
                        Any Suggestion about the Course?
                        

              </div>
              <div class="panel-body">
              <div class="form-group "   >
                    
                          @foreach ($feedback as $feed)
                          <span><label>{{$feed->commenter}} : </label> {{$feed->comment}}</span><br>
                          @endforeach
                </div>
                <form method="POST" action="/admin/commentstr">
                     {{ csrf_field() }}
                       <div class="form-group">
                      
                      <textarea name="comment" id="comment" class="form-control"  > </textarea>
                         <input type="hidden" name="fid" value= "{{$course->feedback}}" class="form-control">
                         <input type="hidden" name="sid" value= "{{$subtopic->sub_tid}}" class="form-control">
                        <input type="hidden" name="cid" value= "{{$subtopic->course_id}}" class="form-control">
                          <input type="hidden" name="tid" value= "{{$subtopic->tid}}" class="form-control">
                            <input type="hidden" name="contentid" value= "{{$subtopic->content_id}}" class="form-control">
                      
                    </div>
                    <div class="form-group">
                        

                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                      
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
    

       </div>     
             
      <div class="panel panel-success">
      <div class="panel-heading">
                <div class="row">
              <div class="col-md-10">
                       <label> Course List </label>
              </div>
              <div class="col-md-2">
                     <a  class="btn btn-danger" href='/admin/rejectcourse/{{$course->id}}'>Reject Course</a>   
              </div>
              </div>

      </div>
      <div class="panel-body">
      
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>See Sub-Topics</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($topic) >0 )
                        @foreach ($topic as $index)
                        <tr>
                            <td><a class='btn btn-primary' onclick="editshow({{$index -> tid}})">+</a></td>
                            
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                           
                            
                             <div  >
                             @foreach ($coursearr as $index1)
                             @if($index1->tid==$index->tid)
                                @if($index1 -> review_status == 'Reviewing')
                                  <tr name="{{$index -> tid}}" class="danger" >
                                  
                                    <td></td>
                                    <td><a  href='/admin/contentreview/{{$index1 -> content_id}}'>{{ $index1 -> name }}</a></td>
                                    <td>{{ $index1 -> description}}</td>
                                    <td><a class="label label-primary"  href='/admin/contentreview/{{$index1 -> content_id}}'>Review this content</a></td>
                                    </tr>
                                 @elseif($index1 -> review_status == 'Correct')
                                      <tr name="{{$index -> tid}}">
                                          <td></td>
                                          <td><a  href='/admin/viewcontent/{{$index1 -> content_id}}'>
                                         {{ $index1 -> name }}</a></td>
                                          <td>{{ $index1 -> description}}</td>
                                          <td > <span class="label label-success">Corrected</span></td>
                                    </tr>
                                   
                                    @elseif($index1 -> review_status == 'Request')
                                      <tr name="{{$index -> tid}}">
                                          <td></td>
                                          <td><a  href='/admin/viewcontent/{{$index1 -> content_id}}'>
                                         {{ $index1 -> name }}</a></td>
                                          <td>{{ $index1 -> description}}</td>
                                          <td > <a class="label label-success" href='/admin/allow/{{$index1 -> content_id}}'>Allow</a></td>
                                    </tr>
                                    @else
                                    <tr name="{{$index -> tid}}">
                                      <td></td>
                                      <td>{{ $index1 -> name }}</td>
                                      <td>{{ $index1 -> description}}</td>
                                      <td></td>
                                    </tr>
                                 @endif
                                 
                                 
                              </tr>
                              @endif
                            @endforeach
                           
                        
                        </div>

                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                    
                </div>
            </div>
          
          
       <script type="text/javascript">
      function editshow(var1){
       // alert(var1);
        // document.getElementsByName("edit").style.display="block";
         // document.getElementById("feedback").style.display="none";
          $('tr[name='+var1+']').css({'style':'display: block'});
          $('tr[name='+var1+']').slideDown();
         
      }
      </script>
      
    </div>
</div>
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