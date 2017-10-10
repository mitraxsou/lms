@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">

                <div class="panel-heading">My Category
                  
                </div>
                <div class="panel-body">
                  <ul>
                  @foreach ($var->categories as $category)
                    <li>{{$category->name}}</li>
                  @endforeach
                </ul>
              </div>    
            </div>
        </div>
    </div>
</div>
@endsection