@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
        <article>
            <p><a href='/admin/{{$quiz->course_id}}/{{$quiz->tid}}/{{$quiz->sub_tid}}/showquiz'>&larr; back to Questions</a></p>
        </article>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Create Quiz</div>

                <div class="panel-body">
                    <form method="POST" action="/admin/ques/{{$quiz->quiz_id}}/storequestion" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="ques_id" class="form-control" value="{{$rand}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="quiz_id" class="form-control" value="{{$quiz->quiz_id}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control">
                                <option value="easy">Easy</option>
                                <option value="moderate">Moderate</option>
                                <option value="difficult">Difficult</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Question Type <i style="color:red;"> * </i></label>
                            <input type="button" id="tf" class="btn btn-default" value="True/False"></input>
                            <input type="button" id="mcq1" class="btn btn-default" value="MCQ-1 ans" ></input>
                            <input type="button" id="mcqmul" class="btn btn-default" value="MCQ-multiple ans" ></input>
                            <input type="button" id="matchmake" class="btn btn-default" value="Match making" disabled></input>
                        </div>

                        <div class="form-group" id="truefalse" style="display: none">
                            <div class="form-group">
                                <!-- <label>Ques type</label> -->
                                <input type="hidden" name="qtype1" class="form-control" value="tf">
                            </div>
                            <div class="form-group">
                                <label>Statement</label>
                                <input type="text" name="statement1" class="form-control" value="Find whether statement is true or false">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <textarea name="question1" id="question1" class="form-control"></textarea>
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
                                <textarea name="explain1" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="mcqone" style="display: none">
                            <div class="form-group">
                                <!-- <label>Ques type</label> -->
                                <input type="hidden" name="qtype2" class="form-control" value="mcq1">
                            </div>
                            <div class="form-group">
                                <label>Statement</label>
                                <input type="text" name="statement2" class="form-control" value="Choose one option from the following">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <textarea id="question2" name="question2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Option 1</label>
                                <input type="text" name="a2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 2</label>
                                <input type="text" name="b2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 3</label>
                                <input type="text" name="c2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 4</label>
                                <input type="text" name="d2" class="form-control">
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
                                <textarea name="explain2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="mcqmulti" style="display: none">
                            <div class="form-group">
                                <!-- <label>Ques type</label> -->
                                <input type="hidden" name="qtype3" class="form-control" value="mcqmul">
                            </div>
                            <div class="form-group">
                                <label>Statement</label>
                                <input type="text" name="statement3" class="form-control" value="Choose more than one option from the following">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <textarea id="question3" name="question3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Option 1</label>
                                <input type="text" name="a3" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 2</label>
                                <input type="text" name="b3" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 3</label>
                                <input type="text" name="c3" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 4</label>
                                <input type="text" name="d3" class="form-control">
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
                                <textarea name="explain3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="match" style="display: none">
                            <div class="form-group">
                                <!-- <label>Ques type</label> -->
                                <input type="hidden" name="qtype4" class="form-control" value="matchmake">
                            </div>
                            <div class="form-group">
                                <label>Statement</label>
                                <input type="text" name="statement4" class="form-control" value="Match the following with most suitable options">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <input type="text" name="question4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 1</label>
                                <input type="text" name="a4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 2</label>
                                <input type="text" name="b4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 3</label>
                                <input type="text" name="c4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 4</label>
                                <input type="text" name="d4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 5</label>
                                <input type="text" name="e4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 6</label>
                                <input type="text" name="f4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 7</label>
                                <input type="text" name="g4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Option 8</label>
                                <input type="text" name="h4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Correct</label>
                                <input type="text" name="correct4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Explanation</label>
                                <textarea name="explain4" class="form-control"></textarea>
                            </div>
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
@section('scripts1')
$(function(){
    $('#tf').click(function(){
        $('#truefalse').show();
        $('#mcqone').hide();
        $('#mcqmulti').hide();
        $('#match').hide();
            document.getElementById("tf").className = "btn btn-primary"
            document.getElementById("mcq1").className = "btn btn-default"
            document.getElementById("mcqmul").className = "btn btn-default"
            document.getElementById("matchmake").className = "btn btn-default"
    });

    $('#mcq1').click(function(){
        $('#truefalse').hide();
        $('#mcqone').show();
        $('#mcqmulti').hide();
        $('#match').hide();
            document.getElementById("tf").className = "btn btn-default"
            document.getElementById("mcq1").className = "btn btn-primary"
            document.getElementById("mcqmul").className = "btn btn-default"
            document.getElementById("matchmake").className = "btn btn-default"
    });
    $('#mcqmul').click(function(){
        $('#truefalse').hide();
        $('#mcqone').hide();
        $('#mcqmulti').show();
        $('#match').hide();
            document.getElementById("tf").className = "btn btn-default"
            document.getElementById("mcq1").className = "btn btn-default"
            document.getElementById("mcqmul").className = "btn btn-primary"
            document.getElementById("matchmake").className = "btn btn-default"
    });
    $('#matchmake').click(function(){
        $('#truefalse').hide();
        $('#mcqone').hide();
        $('#mcqmulti').hide();
        $('#match').show();
            document.getElementById("tf").className = "btn btn-default"
            document.getElementById("mcq1").className = "btn btn-default"
            document.getElementById("mcqmul").className = "btn btn-default"
            document.getElementById("matchmake").className = "btn btn-primary"
    });
});
@endsection
@section('script2')
$(document).ready(function() {

    $('#question1').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", [ "paragraph"]],
                //["table", ["table"]],
                ["insert", ["link", "picture"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
         height: 300,
         placeholder: 'You can provide image / text / link type of contents here.'

    });

        $('#question2').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", [ "paragraph"]],
                //["table", ["table"]],
                ["insert", ["link", "picture"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
         height: 300,
         placeholder: 'You can provide image / text / link type of contents here.'

    });

        $('#question3').summernote({
        toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["paragraph"]],
                //["table", ["table"]],
                ["insert", ["link", "picture"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
         height: 300,
        placeholder: 'You can provide video type of contents here.'
    });


    });
@endsection