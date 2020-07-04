@extends('layouts.app')
@section('title',"| Class Schedule for class-".$class['class_roman'].", ".$class['section'])
@section('routin')
style="border-top:2px solid green;"
@endsection
@section('content')
<div class="d-flex">
    <div class="text-center" style="width:80%;">
        <h1><strong>Daily Schedule for Class-{{$class['class_roman']}}, Section-{{$class['section']}}</strong></h1>
    </div>

    <div class="mx-4" style="width:20%;">
        <form method="post" id="monthForm">
            @csrf
            <input type="hidden" name="class" value="{{$class['id']}}">
            <div class="form-group">
                <select name="month" id="month" class="form-control">
                    <option value="">--Select Month--</option>
                    <option value="Jan">January</option>
                    <option value="Feb">February</option>
                    <option value="Mar">March</option>
                    <option value="Apr">April</option>
                    <option value="May">May</option>
                    <option value="Jun">June</option>
                    <option value="Jul">July</option>
                    <option value="Aug">August</option>
                    <option value="Sep">September</option>
                    <option value="Oct">October</option>
                    <option value="Nov">November</option>
                    <option value="Dec">December</option>
                </select>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="loaderDiv" style="position:absolute; top:167px; width:100%; height:74%; display:none;">
    <x-loader />
</div>
<div id="result">
    <div class="mx-3" style="display:flex; align-items: center; justify-content:center; height:465px; background:#fde2c6; color:#10284b;">
        <span class="display-2 text-capitalize">Select month of your choice</span>
    </div>
</div>

<script>
$(document).ready(()=>{
    var myVar;
    let myForm = document.getElementById('monthForm');
    
    $('#month').change(function(){
        const month=$(this).val();
        if(month){
            
            $.ajax({
                url:"{{route('schedule')}}",
                type:"post",
                data:new FormData(myForm),
                contentType: false,
                cache: false,
                processData: false,
                // dataType:"json",
                beforeSend: function(){
                    $(".loaderDiv").show();
                },
                success:function(res){
                    $('#result').html(res);
                },
                complete:function(data){
                    $(".loaderDiv").hide();
                }
            }); 
            
        }
        
    });
    clearTimeout(myVar);
});
</script>
@endsection