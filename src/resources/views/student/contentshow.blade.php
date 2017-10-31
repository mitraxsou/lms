@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @can('view',$course)
    <article>
        <p><a href='/course/{{$subtopic->course_id}}/{{$subtopic->tid}}'>&larr; back to {{$topic->name}}</a></p>
      </article>
      <div >
       @if((session()->has('incorrect')) )
       @if(!is_array(Session::get('incorrect')))
              <div class="alert alert-success">You have cleared the quiz successfully!</div>
      @else      
       <div class="alert alert-danger">You didn't clear the quiz. Try again.
        <ul>
      @foreach(Session::get('incorrect') as $test)
      <li><p>{!!$test!!}</p><br></li>
      @endforeach
    </ul>
      </div>
      @endif
      @endif
      </div>
       <div class="panel-group">
      <div class="panel panel-success">

      <div class="panel-heading">
          <div class="row">
            <div class="col-sm-12">
              <h3>{{$subtopic->name}}</h3>

              <span style="text-align: left">
              @if(count($pichla)==0)
              @else
                <p>
                <a href="/course/{{$pichla->course_id}}/{{$pichla->tid}}/{{$pichla->sub_tid}}">< {{$pichla->name}}</a>
                </p>
              @endif
              </span>

              <span style="text-align: right">
              @if(count($agla)==0)
              @else
                <p>
                  <a href="/course/{{$agla->course_id}}/{{$agla->tid}}/{{$agla->sub_tid}}">{{$agla->name}} ></a>
                </p>
              @endif
              </span>
            </div>
         </div>
       </div>
      <div class="panel-body">
      <fieldset>
        @if($cont->content_type=="video")
          <video controls style="height: 500px;
                                 width: 600px;
                                 margin-left: 250px;" >
            <source src="{{$video}}" type="" >
          </video>
        @else
          {!!$cont->content!!}
        @endif
      </fieldset>
      
      </div>

      <span style="text-align: center;">
        <p>
        @if($progress->status == 'incomplete'|| $progress->status == 'inprogress')
        
          <a href="/course/markcomplete/{{$subtopic->course_id}}/{{$subtopic->tid}}/{{$subtopic->sub_tid}}" class="btn btn-primary">Continue to Quiz!</a>
          
        @else
          <a href="" class="btn btn-success" disabled>Completed</a>
        @endif
        </p>
      </span>
      
      @if(count($agla)==0)
        <span style="text-align: right">
          @if(count($ntopic)>0)
            <p><button class="btn btn-success">next topic</button><a href="/course/{{$ntopic->course_id}}/{{$ntopic->tid}}/{{$ntopic->sub_tid}}"> {{$ntopic->name}} ></a></p>
          @endif
        </span>
      @endif
       </div>
       </div>

       @endcan

       @cannot('view',$course)

       @endcannot
    </div>
</div>
@endsection