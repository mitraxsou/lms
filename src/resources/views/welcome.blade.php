<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link href="/css/multipicker.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            
                <div class="top-right links">
                    
                        @if(Auth::guard('admin')->check())
                        <a href="{{ url('/adminhome') }}">Admin Home</a>
                         @else
                        <a href="{{ url('/adminlogin') }}">Admin Login</a>
                         @endif
                         @if(Auth::check())
                        <a href="{{ url('/home') }}">Student Home</a>
                         @else
                        <a href="{{ url('/login') }}">Student Login</a>
                         @endif
                
                </div>
          

            <div class="content">
                <div class="title m-b-md">
                    I and We
                </div>

                                
                 <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-success">
                                <div class="panel-heading">Our Courses</div>

                                <div class="panel-body">
                               <fieldset>
                                     
                                      <table class="table table-striped" data-effect="fade" style="color:black;">
                                        <thead>
                                          <tr>
                                              <th>Course</th>
                                              <th>Description</th>
                                              <th>Register</th>
                                            
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if(count($course) >0 )
                                            @foreach ($course as $index)
                                            <tr>
                                              
                                                <td>{{ $index -> name }}</td>
                                                <td>{{ $index -> description}}</td>
                                               
                                                 <td>
                                                    <a class='btn btn-primary' href='/studentreg/{{$index->id}}'>Register</a>
                                                 </td> 
                                                
                                                
                                               
                                                  
                                            </tr>    
                                           
                                                
                                            @endforeach
                                          @else
                                            <p>Not any indexes yet</p>
                                          @endif
                                          </tbody>
                                        </table>
                                    </fieldset>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






            </div>

        </div>
    </body>
</html>
