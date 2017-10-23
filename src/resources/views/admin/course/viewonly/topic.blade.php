@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to all courses</a></p>
      </article>
      
      <div class="row">
      <div class="col-md-12">
       <div class="panel panel-success">
              <div class="panel-heading">
                  <div class="row">
                  <div class="col col-md-6">Comments</div>
                  <div class="col-md-6">
                      
                @if(Auth::guard('admin')->user()->hasRole('super'))
                  <form method="POST" action="/admin/feedbackcorrect" >
                  {{ csrf_field() }}
                  <input type="hidden" name="course_id" value="{{ $publish -> course_id }}">
                   @if($publish -> publish_status != 'Published')

                        <button type="submit" name="Correct" class="btn btn-success pull-right">Good to Go</button>
                    @endif
                           <!-- <input type="button" name="Correct" class="btn btn-danger " value="Edit required" onclick="editshow()"> -->
                    
                  </form>
                  @endif


                  </div>
                  </div>

              </div>
              <div class="panel-body">
              <div class="well well-sm">
                
                <div class="form-group "   >
                    
                          @foreach ($feedback as $feed)
                          <span><label>{{$feed->commenter}} : </label> {{$feed->comment}}</span><br>
                          @endforeach
                </div>
                <div class="form-group "   >
                    <form method="POST"  action="/admin/feedbackpublish/{{$course->feedback}}" >
                      {{ csrf_field() }}
                         <label>Your Comment : </label>
                         <span>
                           <input type="hidden" name="fid" value="{{$publish->feedback}}">
                           <input type="hidden" name="cid" value="{{$course->id}}">
                           <input type="textarea" name="comment" id="comment" class="form-control">
                          <br/>
                           <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                          </span> 
                         <!-- <div class="form-group">
                                <button type="reset" class="btn btn-warning pull-left">Reset
                                </button>
                            
                          
                        </div> -->
                    </form>
                </div>
                </div>
              </div>
        </div>
      </div>
    </div>
    
      <div class="panel panel-success">
      <div class="panel-heading">

                  <h3>{{ $course->name }}</h3>
                  <p>{{$course->description}}</p>
      </div>
      
      <div class="panel-body">
       
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                        <th>Description</th>
                        <th>See Sub-Topics</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($indexes) >0 )
                        @foreach ($indexes as $index)
                        <tr>

                            <td><a class='btn btn-primary' onclick="editshow({{$index -> tid}})">+</a></td>
                            <td>{{ $index -> tid }}</td>
                            <td>{{ $index -> name }}</td>
                            <td>{{ $index -> description}}</td>
                             <!--course chnging-->
                            <div  >
                             @foreach ($indexes_sub as $index1)
                             @if($index1->tid==$index->tid)
                              <tr name="{{$index -> tid}}" style="display:none;">
                                  
                                  <td></td>
                                  <td>{{ $index1 -> sub_tid }}</td>
                                   <td><a  href='/admin/course/{{$index1->course_id}}/{{$index1->tid}}/{{ $index1 -> sub_tid }}'>{{ $index1 -> name }}</a></td>
                                  <td>{{ $index1 -> description}}</td>
                                   <!--course chnging-->
                                   
                              </tr>
                              @endif
                            @endforeach
                           
                        
                        </div> 
                        </tr>
                          <tr>  </tr>

                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                       <tr>
                        


                      </tr>
                      </tbody>
                    </table>
                </div>
        </div>
       <script type="text/javascript">
      function editshow(var1){
       // alert(var1);
        // document.getElementsByName("edit").style.display="block";
         // document.getElementById("feedback").style.display="none";
          $('tr[name='+var1+']').css({'style':'display: block'});
          $('tr[name='+var1+']').slideDown();
         
      }
    </script>
    </div>
</div>
@endsection