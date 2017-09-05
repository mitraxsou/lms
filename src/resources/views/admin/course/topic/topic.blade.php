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
      <div class="panel-heading">
          <div class="row"></div>
                 <div class="col-sm-8"> <h3>{{ $course->name }}</h3>
                  <p>{{$course->description}}</p></div>
                     <div style="float: right;padding: 5px;">
               <br>
               <br>
               
                     <a class="btn btn-danger" href="/admin/reviewstructure/{{$course->id}}">Review Structure</a>
                
               </div>
              </div>
      </div>
      <div class="panel panel-heading">
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
                            <td>{{ $index -> tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                            @if($index->review_status=='Not Reviewed')
                            <td>  <p><a href="/admin/course/{{$index->course_id}}/{{$index->tid}}/createsubtopic">+add more subindexes</a></p></td> <!--course chnging-->
                            <td><a class="btn btn-warning" href="/admin/course/{{$course->id}}/topic/{{$index->tid}}/edit">Edit</a></td>

                            @endif
                             <div  >
                             @foreach ($indexes_sub as $index1)
                             @if($index1->tid==$index->tid)
                              <tr name="{{$index -> tid}}" style="display:none;">
                                  
                                  <td></td>
                                  
                                  <td>{{ $index1 -> sub_tid }}</td>
                                  <td>{{ $index1 -> description}}</td>
                                  @if($index->review_status=='Not Reviewed')
                                     <td>{{ $index1 -> name }}</td>
                                  @elseif($index->review_status=='Reviewing')
                                     <td>{{ $index1 -> name }}</td>
                                    @else
                                     <td><a  href='/admin/mycourse/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>{{ $index1 -> name }}</a></td>
                                    

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