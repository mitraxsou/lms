@extends('admin.layouts')

@section('content')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to course</a></p>
      </article>
      <div class="panel panel-success">
      <div class="panel-heading">
                Review List

      </div>
      <div class="panel-body">
      <fieldset>
      @if(empty($status))
      @if(count($course1) >0 )
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Topic</th> 
                           <th>Name </th>
                          <th>Description</th>
                        <th>View Content</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($course1 as $course)
                        <tr>
                            <td>{{ $course -> sub_tid}}</td>
                            <td>{{ $course -> tid}}</td>
                             <td><a class='btn btn-primary' href='/admin/review/{{ $course -> course_id}}/{{ $course -> tid}}/{{ $course -> sub_tid}}/{{ $course -> content_id }}'>{{ $course -> name }}</a></td>
                            <td>{{ $course -> description }}</td><!-- 
                             <td><a class='btn btn-primary' href='/admin/review/{{ $course -> course_id}}/{{ $course -> tid}}/{{ $course -> sub_tid}}/{{ $course -> content_id }}'>View Flow</a></td> -->
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                  </table>
          @else
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          
                          <th>Corse Name</th> 
                          <th>Course Description </th>
                          <th>Status</th>
                          
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($courses) >0 )
                        @foreach ($courses as $course)
                        @if ( $course -> review_status=='Reviewing')
                        <tr class="info">
                            
                            <td><a  href='/admin/detailreviewstructure/{{$course -> id}}'>{{ $course -> name }}</a></td>
                            <td>
                             {{ $course -> description }}
                            
                            </td>
                           
                             <td class="panel-success">{{ $course -> review_status}}</td>
                             
                          </tr>    
                          @else
                          <tr>
                            <td>{{ $course -> id}}</td>
                            <td><a  href='/admin/detailreviewstructure/{{$course -> id}}'>{{ $course -> name }}</a></td>
                            <td>
                             {{ $course -> description }}
                            
                            </td>
                           
                             <td class="panel-success">{{ $course -> review_status}}</td>
                             
                          </tr>    
                            @endif
<!--                        
                             <td><a class='btn btn-primary' href='/admin/detailreviewstructure/{{$course -> id}}'>View Flow</a></td> -->

                            

                        
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                  </table>
          @endif
          </fieldset>
        </div>
      </div>
       
    </div>
</div>
@endsection