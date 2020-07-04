<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- csrf token -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
	<!-- BOOTSTRAP STYLES-->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    
     <!-- FONTAWESOME STYLES-->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- jqueryUI css cdn -->
<!-- <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/blitzer/jquery-ui.css"> -->

     <!-- MORRIS CHART STYLES-->
    <!-- <link href="{{asset('assets/js/morris/morris-0.4.3.min.css')}}" rel="stylesheet" /> -->
        <!-- CUSTOM STYLES-->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- jqueryUI cdn -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

@yield('headContent')
    <!-- ajax setup -->
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

</head>
<body>
    <div id="wrapper">
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
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    @if(isset($user))
                        <img src="{{asset($user['user_detail']['image']!==null ? $user['user_detail']['image']:'assets/img/find_user.png')}}" class="user-image img-responsive"/>
                    @else                        
                        <img src="{{asset('assets/img/find_user.png')}}" class="user-image img-responsive"/>
                    @endif
					</li>
				
					<li>
                        <a @yield('dashboard') href="{{route('home')}}">
                            @can('isAdmin')
                                <i class="fa fa-home fa-3x"></i> Dashboard
                            @endcan
                            @cannot('isAdmin')
                                <i class="fa fa-user fa-3x"></i> My Profile
                            @endcannot
                        </a>    
                    </li>
   
                    
                    @can('isAdmin')
                    <li>
                        <a @yield('routin') href="{{route('class.routin')}}"><i class="fa fa-table fa-3x"></i>Routin Management</a>
                    </li>
                    <li>
                        <a @yield('vacation') href="{{route('vacation.index')}}"><i class="fa fa-table fa-3x"></i>Vacation Management</a>
                    </li>
                    @endcan
                    @can('isTeacher')
                    <li>
                        <a @yield('routin') href="{{route('teacher.routin')}}"><i class="fa fa-table fa-3x"></i>Routins</a>
                    </li>
                    @endcan	
					
					@can('isAdmin')                   
                    <li>
                        <a href="#" @yield('staffStudent')><i class="fa fa-graduation-cap fa-3x"></i>Staff & Students<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!-- <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li> -->
                            <li>
                                <a href="#">Teachers<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{route('teacher.index')}}">Teachers' List</a>
                                    </li>
                                    <li>
                                        <a href="{{route('teacher.attendance')}}">Teachers' Attendance</a>
                                    </li>
                                    
                                </ul>
                               
                            </li>
                            <li>
                                <a href="#">Students<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{route('student.index')}}">Students' List</a>
                                    </li>
                                    <li>
                                        <a href="{{route('class.attendance')}}">Students' Attendance</a>
                                    </li>
                                    
                                </ul>
                               
                            </li>
                        </ul>
                    </li>  
                    @endcan
                    
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                @yield('content')
             <!-- /. PAGE INNER  -->
            </div>
        </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
     <!-- /. WRAPPER  -->
@yield('footerContent')
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script> -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{asset('assets/js/jquery.metisMenu.js')}}"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <!-- <script src="{{asset('assets/js/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{asset('assets/js/morris/morris.js')}}"></script> -->
      <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    
   
</body>
</html>
