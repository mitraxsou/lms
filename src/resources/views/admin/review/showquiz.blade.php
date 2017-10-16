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
                          <th>Course Name</th>
                          <th>Topic ID</th> 
                           <th>Quiz ID </th>
                          <th>View</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($quiz as $course)
                        <tr>
                            <td>{{ $course -> name}}</td>
                            <td>{{ $course -> tid}}</td>
                            <td>{{ $course -> quiz_id }}</td>
                             <td><a class='btn btn-primary' href='/admin/reviewquiz/{{ $course -> quiz_id}}'>View Quiz</a></td>
                            
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
                Course Name : <label>  {{$course->name}}</label><br> 
                Topic Name : <label>  {{$topic->name}}</label><br>
                Chapter Name :      <label>  {{$subtopics->name}} </label><br>

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
                                              <textarea name="feedback" id="feedback" class="form-control" placeholder="Write your feedback.."></textarea>
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
                           @if(($course->ques_type) == "tf")
                        	<div class="panel-body">
                        	Options a): {{$course->a}} <br>
                        	Options b): {{$course->b}} <br>
                        	</div>
                        	<div class="panel-heading">
                        	Answer : {{$course->correct}} <br>
                        	</div>
                         

                          @elseif(($course->ques_type) == "mcq1")
                          <div class="panel-body">
                          Options a): {{$course->a}} <br>
                          Options b): {{$course->b}} <br>
                          Options c): {{$course->c}} <br>
                          Options d): {{$course->d}} <br>
                          </div>
                          <div class="panel-heading">
                          Answer : {{$course->correct}} <br>
                          </div>
                          @elseif(($course->ques_type) == "mcqmul")
                          <div class="panel-body">
                          Options a): {{$course->a}} <br>
                          Options b): {{$course->b}} <br>
                          Options c): {{$course->c}} <br>
                          Options d): {{$course->d}} <br>
                          </div>
                          <div class="panel-heading">
                          Answer : {{$course->correct}} <br>
                          </div>

                          @endif
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