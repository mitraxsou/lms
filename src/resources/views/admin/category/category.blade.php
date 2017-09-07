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
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                 				<th>Description</th>
                 				<th>Parent ID</th>
                 				<th></th>
                        <th>Delete</th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($categories as $category)
                			<tr>
                  				<td><a href = >{{ $category -> id }} </a></td>
                  				<td>{{ $category -> name }}</td>
                  				<td>{{ $category -> description}}</td>
                  				<td>{{ $category -> parent_id }}</td>
                  				<td><a class='btn btn-primary' href='/admin/category/{{ $category -> id }}'>View</a></td>
                          <td><a class='btn btn-danger' href='/admin/removecategory/{{ $category-> id }}'>Delete</a></td>
                			</tr>    
                    	@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection