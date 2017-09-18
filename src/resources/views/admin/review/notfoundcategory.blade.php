@extends('admin.layouts')

@section('content')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
    <article>
        <p><a href='/adminhome'>&larr; back to Home</a></p>
      </article>
      <div class="panel panel-success">
      <div class="panel-heading">
                Review List

      </div>
      <div class="panel-body">
       <fieldset>
          No courses sent for review under your category!!
        </fieldset>
        </div>
      </div>
       
    </div>
</div>
@endsection