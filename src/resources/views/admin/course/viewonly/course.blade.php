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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Course List</div>

                <div class="panel-body">
                @if(count($courses) >0 )
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                        <th>Description</th>

                        <th>View</th>
                         @if( ! empty($publish))
                        
                         @endif
                			</tr>
              			</thead>
              			<tbody>

                    	@foreach ($courses as $course)
                			<tr>
                  				<td>{{ $course -> id }}</td>
                  				<td>{{ $course -> name }}</td>
                  				<td>{{ $course -> description}}</td>

                          <td><a class='btn btn-primary' href='/admin/course/{{ $course -> id }}' on>View</a></td>
                          
                         @if( ! empty($publish))
                          <td>  
                       <!--     
                @if(Auth::guard('admin')->user()->hasRole('super'))
                  <form method="POST" action="/admin/feedbackcorrect" >
                  {{ csrf_field() }}
                  <input type="hidden" name="course_id" value="{{ $course -> id }}">
                   

                        <button type="submit" name="Correct" class="btn btn-success pull-right">Good to Go</button>
                           
                  </form>
                  @endif -->
                   <div class="form-group" id="edit" style="display:none;">

                    </div>
                   
                
                           </td>
                          @endif
                			</tr>    
                    	@endforeach
                    	</tbody>
                    </table>
                     @else
                                <p>Not any indexes yet</p>
                              @endif
                </div>
                <script type="text/javascript">
      function editshow(){
         // document.getElementById("edit").style.display="block";
          document.getElementById("feedback").style.display="none";
          $("#edit").slideDown();
      }
    </script>

            </div>
        </div>
       @if(Auth::guard('admin')->user()->hasRole('super') and empty($publish))
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Unpublish List</div>
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
                            <form method="POST" action="/admin/unpublish" >
                             {{ csrf_field() }}
                                <label for="sel1">Select a Course To Unpublish:</label> 
                                <select name="course_id" id="course_id">
                                 @foreach ($index as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                  @endforeach
                                 </select><br>
                                 <label>Feedback:</label>
                                 <textarea name="feedback" class="form-control" placeholder="Reason to Unpublish"></textarea>
                                  <br>
                         
                             <div class="form-group">
                               <button type="submit" name="Correct" class="btn btn-primary pull-right">Verify</button>
                             </div>
                            </form>
                        @else
                          <p>No publish list yet</p>
                        @endif
                   </div>

              </div>
              </div>
              @endif
               @if( ! empty($publish))
               @if(Auth::guard('admin')->user()->hasRole('review admin'))
               <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-success">
                <div class="panel-heading">Correction List</div>
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
                                 @if(count($courses)>0)
                                   <form method="POST" action="/admin/feedbackedit" >
                                     {{ csrf_field() }}
                                    <!--  <input type="hidden" name="course_id" value="{{ $course -> id }}"> -->
                                    <label>Corrections <i style="color:red;"> *  </i>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="sel1">Select Course:</label> 
                                    <select name="course_id" id="course_id">
                                    @foreach ($courses as $course)
                                      <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                    </select></label>
                                    <br>
                                 <label>Feedback:</label>
                                    <textarea name="feedback" class="form-control" placeholder="Write Corrections required here"></textarea>
                                    <br>
                                   
                                    <div class="form-group">
                                     <button type="submit" name="Correct" class="btn btn-primary pull-right">Verify</button>
                                     </div>
                                    </form>
                                  @else
                                <p>No correction list yet</p>
                                 @endif
                              
                             
                    </div>
                   
              </div>
               
        </div>
         @endif
        @endif
</div>
</div>
@endsection