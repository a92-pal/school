@extends('layouts.adminLayout')
@section('title','Attendance Management')
@section('staffStudent')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;">Attendance Management Section</h2>   
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
 <hr/>
    
    <div style="width:100%; padding:10px; display:flex; flex-direction:row; justify-content:space-around; flex-flow:wrap;"> 
        <!-- <div style="display:flex;"> -->
        @foreach($class as $cls)
            <div style="margin:10px 0; width:30%; background-color:#ffc66c; text-align:center;">
                <a href="{{route('attendance_form',$cls['id'])}}" style="text-decoration:none;">
                    <div>
                        <h2 style="color:#6e08a1;"><strong>Class {{$cls['class_roman']}}</strong></h2>
                        <h4 style="color:#f00;">Section {{$cls['section']}}</h4>
                    </div>
                </a>
            </div>
        @endforeach
        <!-- </div> -->
    </div>

    
@endsection