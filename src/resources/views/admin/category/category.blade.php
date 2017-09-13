@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Categories<span style="float:right;"><a href="/admin/createcategory">+ Add more</a></span></div>

                <div class="panel-body">
                  <div id="accordian" role="tablist">
                  @foreach ($categories as $category)
                    <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h3 class="mb-0">
                          <a data-toggle="collapse" href="#{{$category->name}}" aria-expanded="true" aria-controls="{{$category->name}}" style="text-decoration: none">+
                          </a>{{ $category->name }} 
                          <a style="float: right" class="btn btn-primary" href="/admin/category/{{$category->id}}">View</a>
                        </h3>
                      </div>

                    <div id="{{$category->name}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                          @foreach($category->childCategories as $child)
                          <ul class="list-group">
                            <a href="/admin/category/{{$child->id}}"><li class="list-group-item list-group-item-primary"> {{$child->name}}</li></a>
                          </ul>
                          @endforeach
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>    
            </div>
        </div>
    </div>
</div>
@endsection