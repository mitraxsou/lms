@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Owner</div>

                <div class="panel-body">
                	<form method="POST" action="/admin/owners/assigncategory">
                	{{ csrf_field() }}
                		<div class="form-group">
                			<label>{{$owner->first_name}} {{$owner->last_name}}</label>
                			<input type="number" name="admin_id" id="admin_id" class="form-control" value="{{$owner->id}}" readonly>
                		</div>
                        <div>
                            <label>Select Categories</label><br/>
                        
                            <ul>
                            @foreach($cat as $c)
                                <li>
                                    <input type="checkbox" value="{{$c->id}}" alt="{{$c->name}}" title="{{$c->name}}">{{$c->name}}
                                    <ul>
                                       @foreach($c->childCategories as $child)
                                       <li>
                                           <input type="checkbox" name="categories[]" value="{{$child->id}}" alt="{{$child->name}}" title="{{$child->name}}">{{$child->name}}
                                       </li>
                                       @endforeach 
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        
                		</div>
                        <div class="form-group">
                			<div class="col-md-offset-4 ">
                				<button type="submit" class="btn btn-primary">Submit
                				</button>
                			</div>
                		</div>
                        @if(count($errors))
                            <div class="alert alert-danger">
                               <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach 
                                </ul>
                            </div>
                        @endif
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts2')
$(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
    });
});
@endsection