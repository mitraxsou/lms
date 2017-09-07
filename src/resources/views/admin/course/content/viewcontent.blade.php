@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/mycourse/{{$course1->course_id}}/{{$course1->tid}}'>&larr; back to {{$course1->name}}</a></p>
      </article>
      <!-- <div class="panel panel-success">

      </div> -->
     <div class="panel-group">
      <div class="panel panel-success">
      <div class="panel-heading">
          <div class="row">
              <div style="float: right;">
              @if($course->content!="")
              <a class="btn btn-warning" href="/admin/mycourse/editmaking/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}">Edit content</a>
              @endif
              @if($course->content_type != "")
                <a class="btn btn-default" href="/admin/mycourse/contentdelete/{{$course->content_id}}">Change content type</a>
              @else
                <a class="btn btn-default" href="/admin/mycourse/contentselection/{{$course1->course_id}}/{{$course1->tid}}/{{$course1->sub_tid}}">Add content</a>
              @endif
              </div>
              <div class="col-sm-8">
              <h3>{{ $course1->name }}</h3>
               <p><b>Description :</b> {{$course1->description}}</p>
               <h4>{{ $course->content_type }}</h4>
              </div>
          </div>
                  
                 
         </div>
      <div class="panel-body">
      <fieldset>
        @if($course->content_type=="video")
          <video controls>
            <source src="{{$video}}" type="">
          </video>
        @else
          {!!$course->content!!}
        @endif
      </fieldset>
      </div>
       </div>
       </div>
    </div>
</div>
@endsection