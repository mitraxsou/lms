@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Trainer Details</div>

                <div class="panel-body">
                	<h3>{{ $trainer -> id }}</h3>
                	<h4>{{ $trainer -> name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection