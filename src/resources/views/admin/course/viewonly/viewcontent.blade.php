@extends('admin.layouts')

@section('content')

 <div class="container">
    <div class="row">
    <article>
        <p><a href='/admin/course/{{$course1->course_id}}'>&larr; back to Topic</a></p>
      </article>
      <!-- <div class="panel panel-success">

      </div> -->
      <div class="panel-group">
      <div class="panel panel-success">
      <div class="panel-heading">
          <div class="row">
              
              <div class="col-sm-8"><h3>{{ $course1->name }}</h3>
               <p><b>Description :</b> {{$course1->description}}</p></div>
          </div>
                  
                 
         </div>
      <div class="panel-body">
      <fieldset>
       @if($course->content!="" )
      {!!$course->content!!}
      @else
        No Contents yet
        @endif
      </fieldset>
      </div>
       </div>
       </div>
    </div>
</div>



@endsection