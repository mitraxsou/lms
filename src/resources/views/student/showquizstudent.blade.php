@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/{{$cid}}/{{$tid}}/quiz'>&larr; back to Quiz List</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            
            @if(count($quizzes)!= 0)
            <div>
            @if(count($questions)>0)
                
                <div class="">
            <form method="POST" action="/student/quiz/{{$quizzes->quiz_id}}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$quizzes->quiz_id}}" name="id" >
                    <input type="hidden" value="{{$quizzes->sub_tid}}" name="stid" >
                    <input type="hidden" value="{{$quizzes->tid}}" name="tid" >
                    <input type="hidden" value="{{$quizzes->course_id}}" name="cid" >
            @foreach($questions as $que)
            <div class="panel panel-success">
              <div class="panel-heading">
                
              <p>Level: <b>{{$que->level}}</b></p>
              <h5>{!!$que->question!!}</h5></div>

              @if($que->ques_type=="tf")
                <div class="panel-body">
                 <input type="radio" name="{{$que->ques_id}}" value="1"> 1.{{$que->a}}<br>
                <input type="radio" name="{{$que->ques_id}}" value="2">2.{{$que->b}} 
                  <br/>
                  
                </div>
              @else
                <div class="panel-body">
                  <input type="radio" name="{{$que->ques_id}}" value="1"> 1.{{$que->a}}<br>
                  <input type="radio" name="{{$que->ques_id}}" value="2">2.{{$que->b}} <br>
                  <input type="radio" name="{{$que->ques_id}}" value="3">3.{{$que->c}} <br>
                  <input type="radio" name="{{$que->ques_id}}" value="4">4.{{$que->d}} <br> 
                  <br/>
                  
                </div>
              @endif

            </div>
            @endforeach    
               <div class="form-group">
                            <div class="col-md-offset-6 ">
                                <button type="submit" class="btn btn-primary">Submit
                                </button>
                            </div>
                </div>
              </form>
            </div>
            @else
             
            @endif
            </div>
            @else
              No quizzes yet
            @endif
        </div>
    </div>
</div>
@endsection