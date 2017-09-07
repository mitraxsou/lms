@extends('layouts.app');

@section('title' ,  $course->name );

@section('content')

@can('view', $course)
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                 				<th>Description</th>
                        		<th>url</th>
                			</tr>
              			</thead>
              			<tbody>
						@foreach ($details as $detail)
							<tr>
                  				<td>{{ $detail -> index_id }}</td>
                  				<td>{{ $detail -> module_name }}</td>
                  				<td>{{ $detail -> description}}</td>
                          		<td><a href="/{{ $detail -> url}}"> {{ $detail -> url}}</a></td>
                			</tr>    
						@endforeach
						</tbody>
					</table>	
				</div>	
			</div>
		</div>	
	</div>
</div>
@endcan

@cannot('view', $course)
<h3>Cannot view this course</h3>
@endcannot


@endsection