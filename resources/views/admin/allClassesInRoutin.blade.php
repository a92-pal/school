@extends('layouts.adminLayout')
@section('title','Routin Management')
@section('routin')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;" class="col-md-8">Routin Management Section</h2>   
            <div class="form-group col-md-4" style="margin-top:14px;">
                <select name="" id="" class="form-control routin_management">
                    <option value="entry">Routin Entry</option>
                    <option value="daysetup">Routin Day setup</option>
                </select>
            </div>
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
    <!-- <div style="width:100%; background:yellow;overflow:hidden; padding:10px;">  -->
        <!-- <div style="display:flex;"> -->
        <!-- @foreach($class as $cls)
            <div style="float:left; margin:10px 0 10px 50px; padding:5px 20px; width:25%; background-color:green;">
                <h2><strong>Class {{$cls['class']}}</strong></h2>
                <h4>Section {{$cls['section']}}</h4>
            </div>
        @endforeach -->
        <!-- </div> -->
    <!-- </div> -->

    <div style="width:100%; padding:10px; display:flex; flex-direction:row; justify-content:space-around; flex-flow:wrap;"> 
        @foreach($class as $cls)
            <div style="margin:10px 0; width:30%; background-color:#ffc66c; text-align:center;" class="path_outerDiv">
            <input type="hidden" class="entry" value="{{route('routin',$cls['id'])}}">
            <input type="hidden" class="daysetup" value="{{route('routin.daysetup',$cls['id'])}}">
                <a href="{{route('routin',$cls['id'])}}" style="text-decoration:none;" class="path">
                    <div>
                        <h2 style="color:#6e08a1;"><strong>Class {{$cls['class_roman']}}</strong></h2>
                        <h4 style="color:#f00;">Section {{$cls['section']}}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

<script>
$(document).ready(function(){
    $("body").on('change',".routin_management",function(){
        var actionType=$(this).val();
        $("."+actionType).map(function(){
            var closestDiv=$(this).closest(".path_outerDiv");
            var actionPath=$("."+actionType,closestDiv).val();
            $('a',closestDiv).attr('href',actionPath);
            console.log(actionPath);
        });
    });
});
</script>
@endsection