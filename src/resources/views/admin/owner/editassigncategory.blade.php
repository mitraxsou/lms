@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/admin/owners/{{$admin->id}}'>&larr; back to {{$admin->first_name}} {{$admin->last_name}}</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
        @if (session('smessage'))
          <div class="alert alert-success">
            {{ session('smessage') }}
          </div>
        @elseif(session('wmessage'))
            <div class="alert alert-danger">
                {{ session('wmessage')}}
            </div>
        @endif
            <div class="panel panel-success">
                <div class="panel-heading"><h4>Categories assigned</h4>
                @foreach($admin->categories as $ac)
                    <h5 class="label label-default">{{$ac->name}}</h5>
                @endforeach
                </div>

                <div class="panel-body">
                    <h4>{{$admin->first_name}} {{$admin->last_name}}</h4>
                    <h5>Add Categories</h5>
                    <ul>
                        @foreach($cat as $ct)
                            <li><a href="/admin/owners/category/add/{{$admin->id}}/{{$ct->id}}"><button class="btn-xs btn-success">+</button></a>{{$ct->name}}
                                <ul>
                                    @foreach($ct->childCategories as $child)
                                        <li><a href="/admin/owners/category/add/{{$admin->id}}/{{$child->id}}"><button class="btn-xs btn-success">+</button></a>{{$child->name}}</li>
                                    @endforeach 
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    <h5>Delete Catgories</h5>
                    <ul>
                    @foreach($admin->categories as $c)
                        <li><a href="/admin/owners/category/delete/{{$admin->id}}/{{$c->id}}"><button class="btn-xs btn-danger">-</button></a>{{$c->name}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
