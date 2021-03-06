@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
      <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Trainer List</div>

                <div class="panel-body">
                	<table class="table table-striped" data-effect="fade">
              			<thead>
                			<tr>
                  				<th>ID</th>
                  				<th>Name</th>
                 				<th></th>
                        <th></th>
                			</tr>
              			</thead>
              			<tbody>
                    	@foreach ($trainers as $trainer)
                			<tr>
                  				<td>{{ $trainer -> id }}</td>
                  				<td>{{ $trainer -> name }}</td>
                          <td><a class='btn btn-primary' href='trainer/{{ $trainer -> id }}'>View</a></td>
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