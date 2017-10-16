@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <article>
            <p><a href='/admin/{{$var->course_id}}/{{$var->tid}}/{{$var->sub_tid}}/showquiz'>&larr; back to Questions</a></p>
        </article>
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-warning">
        		<div class="panel-heading">
        			Edit Question
        		</div>
        		<div class="panel-body">
	        		<form method="POST" action="/admin/question/{{$ques->ques_id}}/editquestion" enctype="multipart/form-data">
	        			 <input type="hidden" name="qtype1"  value="{{$ques->ques_type}}">
	                {{ csrf_field() }}
	                {{ method_field('PATCH') }}
	               
	                	 <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control">
                                <option value="easy">Easy</option>
                                <option value="moderate">Moderate</option>
                                <option value="difficult">Difficult</option>
                            </select>
                        </div>
	                @if(($ques->ques_type) == "tf")
				        	<div class="form-group" id="truefalse">
			                    <div class="form-group">
			                        <label>Statement</label>
			                        <input type="text" name="statement1" class="form-control" value="Find whether statement is true or false">
			                    </div>
			                    <div class="form-group">
			                        <label>Question</label>
			                        <textarea name="question1" id="question1" class="form-control">{{$ques->question}}</textarea>
			                    </div>
			                    <div class="form-group">
			                        <label>Option 1</label>
			                        <input type="text" name="a1" value="true" class="form-control">
			                    </div>
			                    <div class="form-group">
			                        <label>Option 2</label>
			                        <input type="text" name="b1" value="false" class="form-control">
			                    </div>
			                    <div class="form-group">
			                        <label>Correct</label>
			                        <select name="correct1" class="form-control">
			                            <option value="1">Option 1</option>
			                            <option value="2">Option 2</option>
			                        </select>
			                    </div>
			                    <div class="form-group">
			                        <label>Explanation</label>
			                        <textarea name="explain1" class="form-control">{{$ques->explanation}}</textarea>
			                    </div>
			                </div>

			        	@elseif(($ques->ques_type) == "mcq1")
			        		<div class="form-group" id="mcqone">
	                            <div class="form-group">
	                                <label>Statement</label>
	                                <input type="text" name="statement2" class="form-control" value="Choose one option from the following">
	                            </div>
	                            <div class="form-group">
	                                <label>Question</label>
	                                <textarea id="question2" name="question2" class="form-control">{{$ques->question}}</textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Option 1</label>
	                                <input type="text" name="a2" class="form-control" value="{{$ques->a}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 2</label>
	                                <input type="text" name="b2" class="form-control" value="{{$ques->b}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 3</label>
	                                <input type="text" name="c2" class="form-control" value="{{$ques->c}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 4</label>
	                                <input type="text" name="d2" class="form-control" value="{{$ques->d}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Correct</label>
	                                <select name="correct2" class="form-control">
	                                    <option value="1">Option 1</option>
	                                    <option value="2">Option 2</option>
	                                    <option value="3">Option 3</option>
	                                    <option value="4">Option 4</option>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label>Explanation</label>
	                                <textarea name="explain2" class="form-control">{{$ques->explanation}}</textarea>
	                            </div>
                        	</div>
			        	@elseif(($ques->ques_type) == "mcqmul")
			        		<div class="form-group" id="mcqmulti">
	                            <div class="form-group">
	                                <label>Statement</label>
	                                <input type="text" name="statement3" class="form-control" value="Choose more than one option from the following">
	                            </div>
	                            <div class="form-group">
	                                <label>Question</label>
	                                <textarea id="question3" name="question3" class="form-control">{{$ques->question}}</textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Option 1</label>
	                                <input type="text" name="a3" class="form-control" value="{{$ques->a}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 2</label>
	                                <input type="text" name="b3" class="form-control" value="{{$ques->b}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 3</label>
	                                <input type="text" name="c3" class="form-control" value="{{$ques->c}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Option 4</label>
	                                <input type="text" name="d3" class="form-control" value="{{$ques->d}}">
	                            </div>
	                            <div class="form-group">
	                                <label>Choose multiple correct(select multiple by holding ctrl)</label>
	                                <select name="correct3[]" multiple="multiple" class="form-control">
	                                    <option value="1">Option 1</option>
	                                    <option value="2">Option 2</option>
	                                    <option value="3">Option 3</option>
	                                    <option value="4">Option 4</option>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label>Explanation</label>
	                                <textarea name="explain3" class="form-control">{{$ques->explanation}}</textarea>
	                            </div>
                        	</div>
			        	@else
			        		<p>No suitable type of question found</p>
			        	@endif
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