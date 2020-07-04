<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
        <title>SchoolManagement</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
        
    </head>
    <body>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                         @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                sfd
            </div>
        </div> -->
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">School Management</a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                <a class="btn btn-danger square-btn-adjust" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form> 
            </div>

        </nav> 
    </body>
</html>





<div style="width:100%; padding:10px; display:flex; flex-direction:row; justify-content:space-around; flex-flow:wrap;"> 
        <!-- <div style="display:flex;"> -->
        @foreach($class as $cls)
            <div style="margin:10px 0; width:30%; background-color:#ffc66c; text-align:center;">
                <a href="javascript:void(0)" style="text-decoration:none;">
                    <div>
                        <h2 style="color:#6e08a1;"><strong>Class {{$cls['class_roman']}}</strong></h2>
                        <h4 style="color:#f00;">Section {{$cls['section']}}</h4>
                    </div>
                </a>
            </div>
        @endforeach
        <!-- </div> -->
    </div>