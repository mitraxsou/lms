@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @can('view',$course)
    <article>
        <p><a href='/course/{{$subtopic->course_id}}/{{$subtopic->tid}}'>&larr; back to {{$topic->name}}</a></p>
      </article>
      

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
       </div>
       </div>

       @endcan

       @cannot('view',$course)

       @endcannot
    </div>
</div>
@endsection