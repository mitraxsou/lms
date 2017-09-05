@extends('layouts.app')

@section('content')

  
    <div class="container">
 
                         
    <div class="row">
    <article>
        <p><a href='/home'>&larr; back to Home</a></p>
      </article>
      <div class="panel panel-success">
       <div class="panel-heading">

                  <h3><a href='/admin/mycourse/{{$course->id}}'> {{ $course->name }}</a></h3>
                  <p>{{$course->description}}</p>
         </div>
         
      </div>
     
          
      <div class="panel-body">
      <fieldset>
                
                  <table class="table table-striped" data-effect="fade">
                    <thead>
                      <tr>
                         
                        <th>Chapter Name</th>
                        <th>Chapter Description</th>
                        <th>View Content</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                       @if(count($topic)>0)
                          @foreach($topic as $top)
                        <tr>
                            <td>{{$top->name}}</td>
                            <td>{{$top->description}}</td>
                           
                             <td><a class='btn btn-primary' href='/student/read/{{$top->tid}}'>View Content</a></td> 
                            
                            
                        </tr>    
                           <!-- course chnging-->
                        </tr>    
                        @endforeach
                      @else
                        <p>Not any indexes yet</p>
                      @endif
                      </tbody>
                    </table>
                </fieldset>
                </div>
       
    </div>
</div>
@endsection