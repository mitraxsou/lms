@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/mycourse/{{$course->id}}'>&larr; back to {{$course->name}}</a></p>
      </article>
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href='/admin/mycourse/{{$course->id}}'> {{ $course->name }}</a></h3>
                  <p>{{$course->description}}</p>
         </div>
         <div class="panel-body">
           @if(count($topic)>0)
            @foreach($topic as $top)
              <h4>{{$top->name}}</h4>
              <p>{{$top->description}}</p>
            
         </div>
      </div>
      <div class="panel panel-default">
       <div class="panel-heading">
                    <h3> Index List</h3>
                   <p><a href="/admin/course/{{$top->course_id}}/{{$top->tid}}/createsubtopic">+add more subindexes</a></p>
        </div>
               
                
      </div>
            @endforeach
          @endif
      <div class="panel-body">
      <fieldset>
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>Review Status</th>
                        <th>Content</th>
                        <th>Edit Content</th>
                        <th>Review Content</th>
                        <th>Delete</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>
                            <td>{{ $index -> sub_tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                            <td>{{ $index -> review_status}}</td>
                          
                             <td><a class='btn btn-primary' href='/admin/mycourse/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}'>View</a></td> 
                            
                             <!-- <td><a class="btn btn-warning" href="/admin/course/{{$index->course_id}}/{{$index->tid}}/{{$index->sub_tid}}/edit">Edit</a></td> -->

                           <!-- course chnging-->
                            @if($index -> review_status == 'Not Reviewed')

                             <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}'>Edit</a></td> 
                             <td><a class='btn btn-primary' href='/admin/mycourse/review/{{ $index -> course_id }}/{{ $index -> tid }}/{{ $index -> sub_tid }}'>Review</a></td> 

                                 @elseif($index -> review_status == 'Edit Required')
                                  <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}' disabled>Edit Content</a></td> 
                                <td><a class='btn btn-danger' href='/admin/mycourse/edit/{{ $index -> course_id }}/{{ $index -> tid }}/{{ $index -> sub_tid }}'>View to Edit</a></td>


                                @elseif($index -> review_status == 'Correct')
                                 <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}' disabled>Edit Content</a></td> 
                                <td><a class='btn btn-success' disabled href='#'>Reviewed</a></td>


                                @elseif($index -> review_status == 'Reviewing')
                                 <td><a class='btn btn-primary' href='/admin/mycourse/editmaking/{{$index->course_id}}/{{$index->tid}}/{{ $index -> sub_tid }}' disabled>Edit Content</a></td> 
                                <td><a class='btn btn-default' disabled href='/admin/mycourse/{{ $index -> course_id }}/{{ $index -> tid }}/{{ $index -> sub_tid }}'>Reviewing</a></td>
                            @endif
                              <td><a class="btn btn-danger" href="/admin/mycourse/delete/{{ $index -> course_id }}/{{ $index -> tid }}/{{ $index -> sub_tid }}">Delete</a></td>
                        </tr>    
                           <!-- course chnging-->
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                </fieldset>
                </div>
       
    </div>
</div>
@endsection