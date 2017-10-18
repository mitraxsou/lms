@extends('admin.layouts')

@section('content')
@inject('countera','App\Counter')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container">
 
                           @include('sweet::alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Admin's Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                   <div class="col-sm-4"> Admin Home</div>
                   @if(Auth::guard('admin')->user()->hasRole('course admin'))
                   <div class="col-sm-8"> 
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               Discussions
                               @if(count($countera->comment())>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{count($countera->comment())}}</span>
                                 @endif
                                     <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu"  style="min-width: 380px;">
                                    @if(count($countera->comment())>10)
                                    <span class="panel panel-success"><a href="#" data-toggle="modal" data-target="#feed">Read All <b style="border-radius: 25px;
                                    display: inline;
                                    background-color: #8eb4cb;
                                    width: auto;
                                    margin-left: 5px;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    "> {{count($countera->comment())-10}} </b> </a></span>
                                    @endif
                                    @php $i=0; @endphp
                                    @foreach ($countera->comment() as $index)
                                    @php $i++; @endphp
                                    @if($i==10) 
                                    @break;
                                    @else
                                    <li>
                                        <div class="well well-sm" style="margin-bottom: 1px;">
                                        <div class="row">
                                            <div class="col-sm-8">
                                            <b>{{$index->comment}}</b> commented by <b>{{$index->commenter}}</b> in {{$index->name}} 
                                            </div>
                                           
                                       </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                        <div id="feed" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Discussions</h4>
                                      </div>
                                      <div class="modal-body">
                                         @foreach ($countera->comment() as $index)
                                         <div class="well well-sm" style="margin-bottom: 1px;">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                <b>{{$index->comment}}</b> in {{$index->name}} 
                                                </div>
                                               
                                           </div>
                                        </div>
                                        @endforeach
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        @endif
                        @if(Auth::guard('admin')->user()->hasRole('review admin'))
                   <div class="col-sm-8"> 
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               Discussions
                               @if(count($countera->commentreview())>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{count($countera->commentreview())}}</span>
                                 @endif
                                     <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu"  style="min-width: 380px;">
                                    @if(count($countera->commentreview())>10)
                                    <span class="panel panel-success"><a href="#" data-toggle="modal" data-target="#feed">Read All <b style="border-radius: 25px;
                                    display: inline;
                                    background-color: #8eb4cb;
                                    width: auto;
                                    margin-left: 5px;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    "> {{count($countera->commentreview())-10}} </b> </a></span>
                                    @endif
                                    @php $i=0; @endphp
                                    @foreach ($countera->commentreview() as $index)
                                    @php $i++; @endphp
                                    @if($i==10) 
                                    @break;
                                    @else
                                    <li>
                                        <div class="well well-sm" style="margin-bottom: 1px;">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                @if(empty($index->review_status))
                                            <b>{{$index->comment}}</b> commented by <b>{{$index->commenter}}</b> in Publish Course
                                                @else
                                                <b>{{$index->comment}}</b> commented by <b>{{$index->commenter}}</b> in Review Category
                                            
                                            </div>
                                                @endif
                                       </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                        <div id="feed" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Discussions</h4>
                                      </div>
                                      <div class="modal-body">
                                         @foreach ($countera->commentreview() as $index)
                                         <div class="well well-sm" style="margin-bottom: 1px;">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                <b>{{$index->comment}}</b> in {{$index->name}} 
                                                </div>
                                               
                                           </div>
                                        </div>
                                        @endforeach
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::guard('admin')->user()->hasRole('super'))
                   <div class="col-sm-8"> 
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               Discussions
                               @if(count($countera->commentpublish())>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{count($countera->commentpublish())}}</span>
                                 @endif
                                     <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu"  style="min-width: 380px;">
                                    @if(count($countera->commentpublish())>10)
                                    <span class="panel panel-success"><a href="#" data-toggle="modal" data-target="#feed">Read All <b style="border-radius: 25px;
                                    display: inline;
                                    background-color: #8eb4cb;
                                    width: auto;
                                    margin-left: 5px;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    "> {{count($countera->commentpublish())-10}} </b> </a></span>
                                    @endif
                                    @php $i=0; @endphp
                                    @foreach ($countera->commentpublish() as $index)
                                    @php $i++; @endphp
                                    @if($i==10) 
                                    @break;
                                    @else
                                    <li>
                                        <div class="well well-sm" style="margin-bottom: 1px;">
                                        <div class="row">
                                            <div class="col-sm-8">
                                            <b>{{$index->comment}}</b> commented by <b>{{$index->commenter}}</b> in Publish Course
                                            </div>
                                           
                                       </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                        <div id="feed" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Discussions</h4>
                                      </div>
                                      <div class="modal-body">
                                         @foreach ($countera->commentpublish() as $index)
                                         <div class="well well-sm" style="margin-bottom: 1px;">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                <b>{{$index->comment}}</b> in {{$index->name}} 
                                                </div>
                                               
                                           </div>
                                        </div>
                                        @endforeach
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>

            </div>
            <div class = "row">
            @if(Auth::guard('admin')->user()->hasRole('super'))
                <div class="col-sm-6">
                    <div class="panel panel-success">
                    <div class="panel-heading">Owners</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/owners">Show all Owners</a></li>
                                @if(Auth::guard('admin')->user()->hasRole('super'))
                                <!-- <li><a href="/admin/createowner">Create Owners 1</a></li> -->
                                <li><a href="/admin/createowner/multi">Create Owners (new)</a></li>
                                <li><a href="/admin/recreate">Recreate owners
                                 @if($countera->lessonreassign()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonreassign()}}</span>
                                 @endif
                                </a></li>
                                <li><a href="/admin/roles">Manage Roles</a></li>
                                @endif
                            </ul>
                        </div>    
                    </div>
                </div>
            @endif
                
                <!-- <div class="col-sm-4">
                    <div class="panel panel-success">
                    <div class="panel-heading">Student &amp; Enrollments</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="/admin/student">Show all Students</a></li>
                                <li><a href="/admin/createstudent">Create Students</a></li>
                                <li><a href="/admin/enrollmanage">enroll students</a></li>
                            </ul>
                        </div>    
                    </div>
                </div> -->
                <div class="col-sm-6">
                    <div class="panel panel-success">
                    <div class="panel-heading">Course </div>
                        <div class="panel-body">
                            <ul>
                            @if(Auth::guard('admin')->user()->hasRole('review admin'))
                                <li><a href="/admin/publishcourse">Publish Course
                                @if($countera->lessonSuperPublish()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonSuperPublish()}}</span>
                                 @endif

                                </a></li>
                                @endif
                                @if(Auth::guard('admin')->user()->hasRole('super'))
                                <li><a href="/admin/publishlist">Publish List
                                @if($countera->lessonPublish()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonPublish()}}</span>
                                 @endif

                                </a></li>
                                <li><a href="/admin/course">Show all Courses</a></li>
                            @endif
                                @if(Auth::guard('admin')->user()->hasRole('course admin'))
                                <li><a href="/admin/createcourse">Create Course</a></li>
                               
                                
                                <li><a href="/admin/mycourse">My Courses
                                @if($countera->mycourse()>0)
                                 <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">New</span>
                             <!--    <img src="bell1.gif" width="19px" height="17px"></span>
 -->                                 @endif
                             </a>   
                                    <ul>
                                        <li>
                                            <span class="label label-info">Published
                                 @if($countera->published()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color:  #4267b2;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->published()}}</span>
                                 @endif
                            </span><br>
                                        </li>
                                        <li>
                                            <span class="label label-info">Unpublished
                                 @if($countera->unpublished()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->unpublished()}}</span>
                                 @endif

                            </span><br>
                                        </li>
                                    </ul>

                                    </li>
                                     @endif
                                      @if(Auth::guard('admin')->user()->hasRole('super'))
                                <li><a href="/admin/categories">Categories</a></li>
                                  @elseif(Auth::guard('admin')->user()->hasRole('review admin'))
                                    <li><a href="/admin/mycategory">My Categories</a></li>
                                @else
                                @endif
                                  @if(Auth::guard('admin')->user()->hasRole('review admin'))
                                  <li><a href="/admin/reviewquiz">Review Quiz
                                     @if($countera->quiznumber()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->quiznumber()}}</span>
                                @endif

                                  </a></li>
                                <li><a href="/admin/reviewcourse">Review Content
                                 @if($countera->lesson()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lesson()}}</span>
                                @endif
                                </a></li>

                                  <li><a href="/admin/reviewdeletionrequest">Requests for Deletion
                                 @if($countera->del()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->del()}}</span>
                                @endif
                                </a></li>

                                <li><a href="/admin/reviewstr">Review Structure
                                 @if($countera->lessonstr()>0)
                                <span style="border-radius: 25px;
                                    display: inline;
                                    background-color: red;
                                    width: auto;
                                    padding: 0 4px;
                                    line-height: 21px;
                                    color: #fff;
                                    -moz-animation: blink 4s ease-in-out infinite;
                                    animation: blink 4s ease-in-out infinite;
                                    left: 44px;
                                    top: 17px;
                                    ">{{$countera->lessonstr()}}</span>
                                @endif
                                </a></li>
                                @endif
                            </ul>
                        </div>    
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection