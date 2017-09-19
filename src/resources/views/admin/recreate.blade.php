@extends('admin.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
    </article>
      
       @if(Auth::guard('admin')->user()->hasRole('super') )
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><h4><b>Recreate Owner for Rejected Courses</b></h4></div>
                 @if(count($errors))
                                <div class="alert alert-danger">
                                   <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach 
                                    </ul>
                                </div>
                            @endif 
                <div class="panel-body">
                      
                      @if(count($index)>0)
                      
                      
                      @foreach ($index as $course)
                      
                      <div class="row well well-sm" style="margin-bottom: 0px;">
                            <form method="POST" action="/admin/reassign" >
                             {{ csrf_field() }}
                            <div class="col-xs-3">
                            
                             <div class="form-group">
                             <label>Course Name:</label><br>
                             <label class="">  {{$course->name}} </label>
                              </div>
                              </div> 
                               <div class="col-md-4">
                            
                             <div class="form-group"><label>Select New Owner:</label>
                                <select name="admin_id" id="admin_id" class="form-control"> 
                                 @foreach ($index1 as $course1)
                                        <option value="{{$course1->id}}">{{$course1->first_name}}</option>
                                 @endforeach
                                 </select>
                                 <input type="hidden" name="course_id" value="{{$course->id}}">
                              </div> 
                            </div>
                            <div class="col-md-3">
                             <div class="form-group">
                             <br>
                               <button type="submit" name="Correct" class="btn btn-primary pull-right active btn-md ">Reassign</button>
                             </div>
                             </div>
                             
                            </form>
                        </div>
                            <br/>
                             @endforeach
                      
                        @else
                          <p>No publish list yet</p>
                        @endif
                   </div>
              </div>
              </div>
              @endif
              
</div>
</div>
@endsection