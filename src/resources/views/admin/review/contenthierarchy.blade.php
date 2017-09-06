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
      <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-success">
              <div class="panel-heading">
                        {{$course->name}}
                        

              </div>
              <div class="panel-body">
             {!!$course->fixedstructure!!}
              </div>
        </div>
      </div>
    </div>
    

       </div>     
             
      <div class="panel panel-success">
      <div class="panel-heading">
                Course List
                

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
                                  
                                  
                                  
                                  
                                     <td><a  href='/admin/mycourse/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>{{ $index1 -> name }}</a></td>
                                      <td>{{ $index1 -> description}}</td>

                                   <!--course chnging-->
                                   
                                      

                                      
                                               <!--  <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}' disabled>Edit Content</a></td> --> 
                                                <td><a class='btn btn-primary'  href='/admin/contentreview/{{$index1 -> content_id}}'>Review this content</a></td>
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