@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/{{$quiz->course_id}}/{{$quiz->tid}}/{{$quiz->sub_tid}}/showquiz'>&larr; back to Quiz</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Questions<span style="float: right"><a href="/admin/{{$quiz->quiz_id}}/createquestion">+add more Question</a></span></div>
            </div>
            @foreach($ques as $que)
            <div class="panel panel-success">
              <div class="panel-heading">
              <p>Level: {{$que->level}}</p>
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
        </div>
    </div>
</div>
@endsection