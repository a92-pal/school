@extends('layouts.adminLayout')
@section('title','Students')
@section('staffStudent')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-10">
            <h2 style="text-transform:capitalize;">Student Lists</h2>   
    </div>
    <div class="col-md-2">
        <a href="{{route('student.create')}}"><button class="btn btn-success" style="margin-top:26px;">Entry Form</button></a>
    </div>
</div>              
        <!-- /. ROW  -->
<hr />
       
@endsection