@extends('admin.layouts')

@section('content')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to course</a></p>
      </article>
      
      <div class="panel-body">
      <fieldset>
       @if(count($courses) >0 )
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Content </th>
                          
                       
                        
                      </tr>
                    </thead>
                    <tbody>
                     
                        @foreach ($courses as $course1)
                           <tr> <td>Name</td> <td>{{ $course1 -> name }}</td></tr>
                          <tr> <td>Description</td> <td>{{ $course1 -> description }}</td></tr>
                          <tr> <td>Structure</td>  <td>{!! $course1 -> tempstructure !!}</td></tr>
                          <tr> <td>Demo</td> <td>{!! $course1 -> demo_content !!}</td></tr>
                          <tr>  <td><a class="btn btn-success" href="/admin/structuresuccess/{{$course1->id}}">Good to Go!</a></td>
                            <td>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Edit Required</button>
                              
                                <div class="modal fade" id="myModal" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="/admin/reviewcomment" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="form-group">
                                              <label>Course ID</label>
                                              <input type="number" name="id" class="form-control" value="{{ $course1 -> id}}">
                                            </div>
                                            <div class="form-group">
                                              <label> Feedback</label>
                                              <input type="text" name="feedback" id="feedback" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <div class="col-md-offset-4 ">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </div>
                                          </form>
                                      </div>
                                      
                                    </div>
                                    
                                  </div>
                                </div>
                            </td>
                            
                        </tr>    
                        @endforeach
                      
                      </tbody>
                    </table>
                    @else
                        <p>Not any indexes yet</p>
                      @endif
                </fieldset>
                </div>
       
    </div>
</div>
@endsection