@extends('admin.layouts')

@section('content')
@inject('countera','App\NotifyCa')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 
<div class="container">
      @include('sweet::alert')
      @if(count($errors))
                            <div class="alert alert-danger">
                               <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach 
                                </ul>
                            </div>
                        @endif
    <div class="row">
    <article>
        <p><a href='/admin/mycourse'>&larr; back to my courses</a></p>
      </article>
     
      @if($index->review_status!='Okay')
      <div class="row">
        <div class="col-md-8">
         <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>{{ $course ->name }}</h3>
                    <p>{{$course->description}}</p>
                </div>
                <div class="panel-body">
        <div>
          

             @if(count($feedback)>0)
                <div class="well well-sm">
                <label>Feedback</label> <br> 
                <div class="form-group "   >
                    
                          @foreach ($feedback as $feed)
                          <span><label>{{$feed->commenter}} : </label> {{$feed->comment}}</span><br>
                          @endforeach
                </div>
                <div class="form-group "   >
                    <form method="POST"  action="/admin/feedback/{{$index->feedback}}" >
                      {{ csrf_field() }}
                         <label>Your Comment : </label>
                         <span>
                           <input type="hidden" name="fid" value="{{$index->feedback}}">
                           <input type="hidden" name="cid" value="{{$index->course_id}}">
                           <input type="textarea" name="comment" id="comment" class="form-control">
                          <br/>
                           <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                          </span> 
                         <!-- <div class="form-group">
                                <button type="reset" class="btn btn-warning pull-left">Reset
                                </button>
                            
                          
                        </div> -->
                    </form>
                </div>
                </div>
                @endif
                

        </div>
         
         
                
               
               <form method="POST" action="/admin/reviewstructure" enctype="multipart/form-data">
               {{ csrf_field() }}
                <div class="form-group"  >

                        <label>Add the course structure for <i>{{ $course ->name }}</i></label>

                        <textarea id="temporarystructure" name="temporarystructure">{!!$index->tempstructure!!}</textarea>
                       <input type="hidden" name="cid" value="{{$course->id}}">
                 </div>
                
                <div class="form-group"  >
                <label>Add the course template for <i>{{ $course ->name }} </i> : </label>
                        <textarea id="democontent" name="democontent">{!!$index->demo_content!!}</textarea>
                       
                 </div>
                 @if($index->review_status!='Reviewing')
                 <div class="form-group">
                        <div class="col-md-offset-4 ">                        

                        <button type="submit" class="btn btn-primary">Review Structure</button>
                      </div>
                </div>
                @endif
                </form>
              </div>
          </div>
                
                
             
             
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
              <div class="well well-sm">
                
                <div class="form-group "   >
                    
                          @foreach ($feedback as $feed)
                          <span><label>{{$feed->commenter}} : </label> {{$feed->comment}}</span><br>
                          @endforeach
                </div>
                <div class="form-group "   >
                    <form method="POST"  action="/admin/feedback/{{$course->feedback}}" >
                      {{ csrf_field() }}
                         <label>Your Comment : </label>
                         <span>
                           <input type="hidden" name="fid" value="{{$course->feedback}}">
                           <input type="hidden" name="cid" value="{{$course->id}}">
                           <input type="textarea" name="comment" id="comment" class="form-control">
                          <br/>
                           <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                          </span> 
                         <!-- <div class="form-group">
                                <button type="reset" class="btn btn-warning pull-left">Reset
                                </button>
                            
                          
                        </div> -->
                    </form>
                </div>
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
                        <th>Quiz</th>
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

                            <td><a href="/admin/{{$index->course_id}}/{{$index->tid}}/quiz">See Quiz</a></td>
                            <!--Quiz related to each topic-->

                            <td><a class="btn btn-warning" href="/admin/course/{{$course->id}}/topic/{{$index->tid}}/edit">Edit</a></td>
                            <td>
                                <span class="label label-info">Edit Required
                                 @if($countera->edittopic($index->course_id,$index->tid)>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->edittopic($index->course_id,$index->tid)}}</span>
                                 @endif
                            </span><br>
                            <span class="label label-info">Good to Go
                                @if($countera->correcttopic($index->course_id,$index->tid)>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->correcttopic($index->course_id,$index->tid)}}</span>
                                 @endif
                            </span>
                            </td>
                           
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
                                                 <td><a class='btn btn-primary btn-sm' href='/admin/mycourse/review/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>Review Content</a></td> 
                                                 <td></td>
                                                  <td><a class="btn btn-danger btn-sm" href="/admin/mycourse/delete/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}">Delete</a></td>

                                                @elseif($index1 -> review_status == 'Edit Required')
                                                <!-- <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> --> 
                                                <td><a class='btn btn-danger btn-sm' href='/admin/mycourse/edit/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>View to Edit</a></td>
                                                <td></td>
                                                 <td><a class="btn btn-danger btn-sm" href="/admin/mycourse/delete/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}">Delete</a></td>


                                                @elseif($index1 -> review_status == 'Correct' )
                                                <!-- <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> 
                                                 --><td><a class='btn btn-success btn-sm' disabled href='#'>Reviewed</a></td>
                                                 <td></td>
                                                    <td><a class="btn btn-warning btn-sm" href="/admin/mycourse/askdelete/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}">Request Delete</a></td>

                                                @elseif($index1 -> review_status == 'Request' )
                                                      <td><a class='btn btn-success btn-sm' disabled href='#'>Reviewed</a></td>
                                                      <td></td>
                                                      <td><a class="btn btn-warning btn-sm" disabled href="/admin/mycourse/askdelete/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}">Request Delete</a></td>

                                                     
                                                @elseif($index1 -> review_status == 'Reviewing')
                                               <!--  <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> --> 
                                                <td><a class='btn btn-default btn-sm' disabled href='/admin/mycourse/{{ $index1 -> course_id }}/{{ $index1 -> tid }}/{{ $index1 -> sub_tid }}'>Reviewing</a></td>
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
 
        $('#temporarystructure').summernote({
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
           
            $('#democontent').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", [ "paragraph"]],
                //["table", ["table"]],
                ["insert", ["link", "picture","video"]],
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