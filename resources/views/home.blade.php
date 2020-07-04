@extends('layouts.adminLayout')
@section('title', 'Dashboard')

@section('dashboard')
    class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;">{{Auth::user()->user_type}}'s Dashboard</h2>   
            <h5>Welcome <span style="text-transform:capitalize;">{{Auth::user()->name}}</span> , Love to see you back. </h5>
    </div>
</div>              
   @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>

    <script>
        $(document).ready(()=>{
            setTimeout(() => {
                $('.alert-success').hide()
            }, 5000);
        });
    </script>
   @endif
        <!-- /. ROW  -->
        <hr />
    @can('isAdmin')
    
    <div class="row admin" style="padding:0px;">
        <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-graduation-cap"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text" id="students">{{$students}}</p>
                    <p class="text-muted">Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-book"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text" id="teachers">{{$teachers}}</p>
                    <p class="text-muted">Teachers</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text" id="visitors">{{constant('VISITORS')}}</p>
                    <p class="text-muted">Total Visitors</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">3 Orders</p>
                    <p class="text-muted">Pending</p>
                </div>
            </div>
        </div>
    </div>
    <hr /> 
    @endcan     
    @can('isTeacher') 
        @include('teacher.dashboard')
    @endcan

    @can('isStudent')  
        @include('student.dashboard')
    @endcan
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>

     // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e60dad725a09dabecbca', {
    cluster: 'ap2',
    forceTLS: true
    });

    var channel = pusher.subscribe('realtime-count');
    channel.bind('my-event', function(data) {
        if(data){
            $('#students').html(data.students);
            $('#teachers').html(data.teachers);
            $('#visitors').html(data.visitors);
        }
    });

    

</script>

<script>
// $(document).ready(function(){
//     reloadDiv();
// })
// function reloadDiv(){
//     $('.admin').load(' .admin');
//     setTimeout(function() {
//         reloadDiv();
//     }, 2000);
// }
</script>

@endsection
