@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <article>
            <p><a href='/admin/{{$course->id}}/{{$topic->tid}}/{{$subtopic->sub_tid}}/showquiz'>&larr; back to Quiz details</a></p>
        </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Quiz for {{$subtopic->name}}</div>

                <div class="panel-body">
                    <form method="POST" action="/admin/{{$course->id}}/{{$topic->tid}}/{{$subtopic->sub_tid}}/quiz">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label>Quiz ID</label>
                            <input type="number" name="quiz_id" class="form-control" value="{{$x}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="cid" value= "{{$course->id}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="tid" value= "{{$topic->tid}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="stid" value= "{{$subtopic->sub_tid}}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 ">
                                <button type="submit" class="btn btn-primary">Create
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