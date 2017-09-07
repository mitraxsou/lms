@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course'>&larr; back to all courses</a></p>
      </article>
      <div class="panel-heading">

                  <h3>{{ $course->name }}</h3>
                  <p>{{$course->description}}</p>
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
                             <!--course chnging-->
                            <div  >
                             @foreach ($indexes_sub as $index1)
                             @if($index1->tid==$index->tid)
                              <tr name="{{$index -> tid}}" style="display:none;">
                                  
                                  <td></td>
                                  <td>{{ $index1 -> sub_tid }}</td>
                                   <td><a  href='/admin/course/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>{{ $index1 -> name }}</a></td>
                                  <td>{{ $index1 -> description}}</td>
                                   <!--course chnging-->
                                   
                              </tr>
                              @endif
                            @endforeach
                           
                        
                        </div> 
                        </tr>
                          <tr>  </tr>

                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                       <tr>
                        


                      </tr>
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