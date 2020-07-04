@extends('layouts.app')
@section('title','| Classes Schedule')
@section('routin')
style="border-top:2px solid green;"
@endsection
@section('content')

<div>
    <h2 class="text-center" style="text-transform:capitalize;"><strong>Select your choice</strong> </h2>   
</div>
 <hr/>
<div class="row d-flex justify-content-center" style="margin:10px; padding:10px;">
    @foreach($class as $cls)
        <div class="col-md-2 rounded" style="margin:5px 5px; padding:5px; background-color:#ffc66c; text-align:center;">
            <a href="{{route('class.schedule',$cls['id'])}}" style="text-decoration:none;">
                <div>
                    <h2 style="color:#6e08a1;"><strong>Class {{$cls['class_roman']}}</strong></h2>
                    <h4 style="color:#f00;">Section {{$cls['section']}}</h4>
                </div>
            </a>
        </div>
    @endforeach
</div>
    

    
@endsection