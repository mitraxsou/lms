@extends('layouts.app')

@section('content')

  
    <div class="container">
 
                         
    <div class="row">
    <article>
        <p><a href='/home'>&larr; back to Home</a></p>
      </article>
       @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif                                           
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href='/course/{{$course->id}}'> {{ $course->name }}</a></h3>
                  <p>{{$course->description}}</p>
         </div>
         
      </div> 
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
          @can('view',$course)
            @foreach($topic as $top)
            <div class="row">
              <div class="col-sm-6">
                <span style="text-align: left"><h4><a href="/course/{{$course->id}}/{{$top->tid}}">{{$top->name}}</a></h4>
                  <br/>
                  <p>{{$top->description}}</p>
                </span>  
                
                
              </div>
              <div class="col-sm-6">
                <ul style="list-style: none">
                  @foreach($subtopic as $sub)
                    @if($top->tid == $sub->tid)
                      <li><a href="">{{$sub->name}}</a></li>
                    @endif
                  @endforeach
                </ul>
              </div>
              
                
            </div>
            <hr>
            @endforeach
          @endcan
        </div>
        </div>
          @cannot('view',$course)
                <div class="col-sm-6">
                  <fieldset>

                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                         
                        <th>Chapter Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <ol>
                       @if(count($topic)>0)
                          @foreach($topic as $top)
                        <tr>
                          
                            <td><li>{{$top->name}}</li></td>
                           
                            
                        </tr> 
                              
                        @endforeach
                      </ol>
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                  
                </fieldset>
                </div>
                <div class="col-sm-6">
                  <a href="/course/enroll/{{$course->id}}" class="btn btn-primary btn-lg">Register</a>
                </div>
                @endcannot
       </div>
    </div>
</div>
@endsection