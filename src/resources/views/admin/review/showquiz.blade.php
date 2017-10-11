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
      <div class="panel panel-info">
      
      @if(empty($status))
      @if(count($quiz) >0 )
      <div class="panel-heading">
                Review List

      </div>
      <div class="panel-body">
      <fieldset>
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Topic</th> 
                           <th>Name </th>
                          <th>Description</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($quiz as $course)
                        <tr>
                            <td>{{ $course -> sub_tid}}</td>
                            <td>{{ $course -> tid}}</td>
                             <td><a class='btn btn-primary' href='/admin/reviewquiz/{{ $course -> quiz_id}}'>{{ $course -> quiz_id }}</a></td>
                            <td>{{ $course -> course_id }}</td>
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                  </table>
                   </fieldset>
        </div>
          @else
          <div class="panel-heading">
                 <div class="row">
              <div class="col-md-8">
                       <label> Quiz List </label>
              </div>
              <div class="col-md-2">
                   <input type="button" name="Correct" class="btn btn-danger pull-left" value="Edit required" data-toggle="modal" data-target="#myModal">
                   <div class="modal fade" id="myModal" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="/admin/reviewquizedit" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="form-group">
                                              <label>Course ID</label>
                                              <input type="number" name="qid" class="form-control" value="{{$status}}" readonly="">
                                            </div>
                                            <div class="form-group">
                                              <label> Feedback</label>
                                              <input type="text" name="feedback" id="feedback" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <div class="col-md-offset-4 ">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </div>
                                          </form>
                                      </div>
                                      
                                    </div>
                                    
                                  </div>
                                </div>
              </div>
              <div class="col-md-2">
                     <a  class="btn btn-success" href="/admin/reviewquizcorrect/{{$status}}">Good to Go!</a>   
              </div>
          </div>
     	</div>
     	 <div class="panel-body">
     		 <fieldset>
           		 	 @if(count($questions) >0 )
                        @foreach ($questions as $course)

                        <div class="panel panel-success">
                        	<div class="panel-heading">
                        	Question:	{{$course->question}}
                        	</div>
                        	<div class="panel-body">
                        	Options a): {{$course->a}} <br>
                        	Options b): {{$course->b}} <br>
                        	</div>
                        	<div class="panel-heading">
                        	Answer : {{$course->correct}} <br>
                        	</div>
                        </div>
                        
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif         
                      
          @endif
          </fieldset>
        </div>
      </div>
       
    </div>
</div>
@endsection