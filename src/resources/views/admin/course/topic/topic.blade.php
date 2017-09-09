@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 
<div class="container">
      @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/admin/mycourse'>&larr; back to my courses</a></p>
      </article>
     
      @if($index->review_status!='Okay')
      <div class="row">
        <div class="col-md-8">
         <form method="POST" action="/admin/reviewstructure" enctype="multipart/form-data">
          <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>{{ $course ->name }}</h3>
                    <p>{{$course->description}}</p>
                </div>
               
                {{ csrf_field() }}
                <div class="panel-body">
                @if($index->feedback!=null)
                <div class="form-group"  >
                    <label>Feedback</label>         
                    <textarea class="form-control" readonly="">{{$index->feedback}}</textarea>
                 
                </div>
                @endif
                <div class="form-group"  >

                        <label>Add the course structure for <i>{{ $course ->name }}</i></label>

                        <textarea id="summernote" name="summernote">{!!$index->tempstructure!!}</textarea>
                       <input type="hidden" name="cid" value="{{$course->id}}">
                 </div>
                
               
               
             
                    
               
                
                <div class="form-group"  >
                <label>Add the course template for <i>{{ $course ->name }} </i> : </label>
                        <textarea id="summernote1" name="summernote1">{!!$index->demo_content!!}</textarea>
                       
                 </div>
                 @if($index->review_status!='Reviewing')
                 <div class="form-group">
                        <div class="col-md-offset-4 ">                        

                        <button type="submit" class="btn btn-primary">Review Structure</button>
                      </div>
                </div>
                @endif
                </div>
                </div>
                
                
             
              </form>
          </div>
          <div class="col-md-4">
                
            <div class="panel panel-success">
              <div class="panel-heading">
                        Final Structure
                        

              </div>
              <div class="panel-body">
              {!!$index->fixedstructure!!}
              </div>
            </div>
       
        </div>
      </div>
    @else
    <div class="row">
      <div class="col-md-8">
       <div class="panel panel-success">
              <div class="panel-heading">
                        Final Structure
                        

              </div>
              <div class="panel-body">
             {!!$index->fixedstructure!!}
              </div>
        </div>
      </div>
      
      <div class="col-md-4">
       <div class="panel panel-success">
              <div class="panel-heading">
                  Comments
                        

              </div>
              <div class="panel-body">
              @if($index->feedback!=null)
              
             <textarea class="form-control" readonly=""> {{$index->feedback}}</textarea>
              
              @else
                <label>No comments yet</label>
              @endif
              </div>
        </div>
      </div>

    </div>
    @endif

       </div>     
        @if( !empty($indexes))         
      <div class="panel panel-success">
      <div class="panel-heading">
                Index List
                <p><a href="/admin/{{$course->id}}/createtopic">+add more indexes</a></p>

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
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>
                            <td><a class='btn btn-primary' onclick="editshow({{$index -> tid}})">+</a></td>
                            
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                           
                            <td>  <p><a href="/admin/course/{{$index->course_id}}/{{$index->tid}}/createsubtopic">+add more subindexes</a></p></td> <!--course chnging-->
                            <td><a class="btn btn-warning" href="/admin/course/{{$course->id}}/topic/{{$index->tid}}/edit">Edit</a></td>

                           
                             <div  >
                             @foreach ($indexes_sub as $index1)
                             @if($index1->tid==$index->tid)
                              <tr name="{{$index -> tid}}" style="display:none;">
                                  
                                  <td></td>
                                  
                                  
                                  
                                  
                                     <td><a  href='/admin/mycourse/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>{{ $index1 -> name }}</a></td>
                                    <td>{{ $index1 -> description}}</td>

                                   <!--course chnging-->
                                   
                                        @if($index1 -> review_status == 'Not Reviewed')

                                                <!-- <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>Edit Content</a></td> 
                                                 -->
                                                 <td><a class='btn btn-primary' href='/admin/mycourse/review/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>Review Content</a></td> 

                                                @elseif($index1 -> review_status == 'Edit Required')
                                                <!-- <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> --> 
                                                <td><a class='btn btn-danger' href='/admin/mycourse/edit/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>View to Edit</a></td>


                                                @elseif($index1 -> review_status == 'Correct')
                                                <!-- <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> 
                                                 --><td><a class='btn btn-success' disabled href='#'>Reviewed</a></td>


                                                @elseif($index1 -> review_status == 'Reviewing')
                                               <!--  <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> --> 
                                                <td><a class='btn btn-default' disabled href='/admin/mycourse/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>Reviewing</a></td>
                                         @endif
                                 
                              <td><a class="btn btn-danger" href="/admin/mycourse/delete/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}">Delete</a></td>
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
          @endif
          
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