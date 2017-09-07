@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/{{$cid}}/{{$tid}}/quiz'>&larr; back to Quiz List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Quiz Details</div>

                <div class="panel-body">
                    @if(count($quizzes)>0)
                    	<h4>Questions</h4>
                        <p><a class="btn btn-primary" href="/admin/quiz/{{$quizzes->quiz_id}}/questions">View Questions</a></p>
                    @else
                    <h3>No quiz for this Subtopic</h3><br/>
                    <a class="btn btn-primary" href="/admin/{{$cid}}/{{$tid}}/{{$stid}}/createquiz">create</a>
                    @endif
                </div>
            </div>
            @if(count($quizzes)!= 0)
            <div>
            @if(count($questions)>0)
                <div class="panel panel-default">
                	<div class="panel-heading"><h3>Question</h3></div>
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