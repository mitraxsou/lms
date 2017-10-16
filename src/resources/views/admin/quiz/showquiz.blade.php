@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/{{$cid}}/{{$tid}}/quiz'>&larr; back to Quiz List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            @if(count($quizzes)>0)
            @else
            <div class="panel panel-success">
                <div class="panel-heading">Quiz Details</div>

                <div class="panel-body">
                    <h3>No quiz for this Subtopic</h3><br/>
                    <a class="btn btn-primary" href="/admin/{{$cid}}/{{$tid}}/{{$stid}}/createquiz">create</a>
                    
                </div>

            </div>
            @endif
            @if(count($quizzes)!= 0)
            <div>
            @if(count($questions)>0)
                <div class="panel panel-default">
                	<div class="panel-heading">
                        <h4>Status</h4>
                       <!--  <p><a class="btn btn-primary" href="/admin/quiz/{{$quizzes->quiz_id}}/questions">View Questions</a></p> -->
                       
                        @if($quizzes->review_status == 'Not Reviewed')
                            <p>Are you sure you want to send this quiz for review?<a class="btn btn-primary pull-right" href="/admin/quiz/review/{{$quizzes->quiz_id}}">Review Quiz</a></p>
                        @elseif($quizzes->review_status == 'Edit')
                            <p>Feedback:  <a class="btn btn-primary pull-right btn-sm" href="/admin/quiz/review/{{$quizzes->quiz_id}}">Resubmit for Review</a></p>
                                <div class="well well-sm"> 
                                {{$quizzes->feedback}}
                             </div>
                                
                        @elseif($quizzes->review_status == 'Correct')
                            <p>Correct <a class="btn btn-success pull-right" disabled href="#">Reviewed</a></p>
                        @elseif($quizzes->review_status == 'Reviewing')
                            <p>Reviewing</p>
                        @endif
                     
                    </div>
                	<div class="panel-body">

                		<table class="table table-striped" data-effect="fade">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Easy</th>
                                <th>Moderate</th>
                                <th>Difficult</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No of questions</td>
                                <td>{{count($easy)}}</td>
                                <td>{{count($moderate)}}</td>
                                <td>{{count($difficult)}}</td>
                            </tr>
                        
                        </tbody>
                    </table>
                	</div>
                </div>
                <div class="">
            <div class="panel panel-success">
                @if($quizzes->review_status == 'Edit')
                <div class="panel-heading">Questions<span style="float: right"><a href="/admin/{{$quizzes->quiz_id}}/createquestion">+add more Question</a></span></div>
                @endif
                @if($quizzes->review_status == 'Not Reviewed')
                <div class="panel-heading">Questions<span style="float: right"><a href="/admin/{{$quizzes->quiz_id}}/createquestion">+add more Question</a></span></div>
                @endif
            </div>
            @foreach($questions as $que)
            <div class="panel panel-success">
              <div class="panel-heading">
                @if($quizzes->review_status == 'Edit')
                <span style="float: right;"><a class="btn-sm btn-warning" href="/admin/question/{{$que->ques_id}}/edit">Edit</a></span>
                @endif
                 @if($quizzes->review_status == 'Not Reviewed')
                <span style="float: right;"><a class="btn-sm btn-warning" href="/admin/question/{{$que->ques_id}}/edit">Edit</a></span>
                @endif
              <p>Level: <b>{{$que->level}}</b></p>
              <h5>{!!$que->question!!}</h5></div>

              @if($que->ques_type=="tf")
                <div class="panel-body">
                  <p>1.{{$que->a}}</p>
                  <p>2.{{$que->b}}</p> 
                  <br/>
                  <p><b>Correct :</b> {{$que->correct}}</p> 
                </div>
              @else
                <div class="panel-body">
                  <p>1.{{$que->a}}</p>
                  <p>2.{{$que->b}}</p>
                  <p>3.{{$que->c}}</p>
                  <p>4.{{$que->d}}</p>
                  <br/>
                  <p><b>Correct :</b> {{$que->correct}}</p> 
                </div>
              @endif

            </div>
            @endforeach    
              
            </div>
            @else
             	<div class="panel panel-warning">
             		<div class="panel-heading"><h3>No Questions yet</h3></div>
                	<div class="panel-body">
                		
                		<a class="btn btn-primary" href="/admin/{{$quizzes->quiz_id}}/createquestion">Create</a>
                	</div>
                </div>
            @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection