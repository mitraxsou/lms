@extends('admin.layouts')

@section('content')
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="/admin/createowner/multi" id="msform">
        {{ csrf_field() }}
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Personal Details</li>
                <li>Social Profiles</li>
                <li>Account Setup</li>
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
            <fieldset id="personal">
                <h2 class="fs-title">Personal Details</h2>
                <h3 class="fs-subtitle">Tell us something more about you</h3>
                <input type="text" name="fname" id="fname" placeholder="First Name *" required="" />
                <input type="text" name="lname" id="lname" placeholder="Last Name *" required="" />
                <input type="email" name="email" id="email" placeholder="Email *" required="" />
                <input type="text" name="password" id="password" placeholder="Password *" required="" />
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Assign Roles</h2>
                <h3 class="fs-subtitle">Assign role to the user</h3>
                <select class="form-control" name="role">
                	@foreach($roles as $role)
                		<option name="{{$role->name}}" value="{{$role->id}}">{{$role->display_name}}</option>
                	@endforeach
                </select>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Choose Categories</h2>
                <h3 class="fs-subtitle">select categories</h3>
                <label class="custom-control custom-checkbox">
                <ul>
                    @foreach($categories as $c)
                        <li>
                            <input type="checkbox" value="{{$c->id}}" alt="{{$c->name}}" title="{{$c->name}}" class="custom-control-input">
                            <span class="custom-control-description">{{$c->name}}</span>
                            <ul>
                            @foreach($c->childCategories as $child)
                                <li>
                    	            <input type="checkbox" name="categories[]" value="{{$child->id}}" alt="{{$child->name}}" title="{{$child->name}}" class="custom-control-input">
                            		{{$child->name}}
                                </li>
                            @endforeach 
                            </ul>
                        </li>
                    @endforeach
                </ul>
                </label>
                <br/>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>

        </form>
        
    </div>
</div>
<!-- /.MultiStep Form -->
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
	

	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var email = $("#email").val();
	var pass = $("#password").val();

	

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
	
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var email = $("#email").val();
	var pass = $("#password").val();

	if((fname || lname || email || pass)=="" )
	{
		window.alert("Please fill all the fields");
	}
	return true;
});

});
@endsection
