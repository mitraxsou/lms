@extends('admin.layouts')

@section('content')
@inject('countera','App\NotifyCa')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
                        
    <div class="row">
     
    <article>
    
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Course List</div>
                
                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			@if(count($courses) >0 )
                    <thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                        <th>Description</th>
                        <th></th>
                			</tr>
              			</thead>
              			<tbody>
                    
                    	@foreach ($courses as $course)
                			<tr>                      
                          <td>{{ $course -> id }}</td>

                          <td>
                              <a  href='mycourse/{{ $course -> id }}'>{{ $course -> name }}</a>
                              </td>
                          <td>{{ $course -> description}}</td>

                          

                          
                          <td><a  href="/admin/course/{{$course->id}}/edit"><img src="../edit.png" height="20px" width="20px"></img></a></td>

                          <td><a class="btn btn-success" href="/admin/course/publish/{{$course->id}}">Publish</a></td>
                          <td>
                            <span class="label label-info">Edit Required
                                 @if($countera->edit($course -> id)>0)
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
                                    ">{{$countera->edit($course -> id)}}</span>
                                 @endif
                            </span><br>
                            <span class="label label-info">Good to Go
                                @if($countera->correct($course -> id)>0)
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
                                    ">{{$countera->correct($course -> id)}}</span>
                                 @endif
                            </span><br>
                            <span class="label label-info">Comments
                              @if($countera->feedback($course -> id)>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: #4267b2;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->feedback($course -> id)}}</span>
                                 @endif</span>
                          </td>
                   
                        
                			</tr>    
                    
                       @endforeach
                        @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                        @if (session('alert'))
                        <div class="alert alert-danger">
                        
                          {{ session('alert') }}
                          
                        </div>
                        @endif
                    </table>
                  </div>
                </div>
                </div>

                </div>

                <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Publish List</div>

                <div class="panel-body">
                  <div class="panel-body">
                  <table class="table table-striped" data-effect="fade">
                  @if(count($publish) >0 )
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Feedback</th>
                      </tr>
                    </thead>
                    <tbody>
                
                      @foreach ($publish as $pb)
                      <tr>
                          <td>{{ $pb -> course_id }}</td>
                          <td>{{ $pb -> name }}</td>
                          <td>{{ $pb -> description}}</td>

                          @if($pb -> publish_status == 'Not Published')

                             <td><a class="btn btn-default" href="#" disabled>Publishing</a></td>

                                 @elseif($pb -> publish_status == 'Published')
                                   <td><a class="btn btn-success" href="#" disabled>Published</a></td>



                                @elseif($pb -> publish_status == 'Edit')
                                
                                <td><a class="btn btn-danger " href="/admin/publishedit/{{$pb->course_id}}">Change Description</a>
                                </td>
                                <div class="form-group">
                                 <td><textarea >{{$pb->feedback}}</textarea></td>
                                 </div>
                              
                            @endif
                          
                         
                      </tr>
                       @endforeach
                        @else
                        <p>Not any indexes yet</p>
                      @endif
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection