@extends('admin.layouts')

@section('content')
<div class="container">
    <div class="row">
    	<article>
    		<p><a href='/adminhome'>&larr; back to Home</a></p>
    	</article>

            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="/admin/createcourse" id="msform">
                {{ csrf_field() }}
                        <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Category assignment</li>
                        <li>Course details</li>
                    </ul>
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach 
                            </ul>
                        </div>
                    @endif
                        <!-- fieldsets -->
                        
                    <fieldset>
                        <h2 class="fs-title">Choose Categories</h2>
                        <h3 class="fs-subtitle">select categories</h3>
                        <label class="custom-control custom-checkbox">
                        <select name="category" class="form-control">
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        </label>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Course details</h2>
                        <h3 class="fs-subtitle">Fill the details about the course</h3>
                        <input type="text" name="name" id="name" placeholder="Course Name *" required="" />
                        <input type="textarea" name="description" id="description" placeholder="Description *" required="" />
                            
                        <br/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                    </fieldset>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts1')
$(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
    });
});
@endsection

@section('scripts2')
$(function () {

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
    if(animating) return false;
    animating = true;
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    

    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
            next_fs.css({'left': left, 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
        //this comes from the custom easing plugin
        //easing: 'easeInOutBack'
        

    //activate next step on progressbar using the index of next_fs
    
    });
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
        //this comes from the custom easing plugin
        //easing: 'easeInOutBack'
    });
});

$(".submit").click(function(){
    
    var id = $("#id").val();
    var name = $("#name").val();
    var desc = $("#description").val();


    if((id || name || desc )=="" )
    {
        window.alert("Please fill all the fields");
    }
    return true;
});

});
@endsection
