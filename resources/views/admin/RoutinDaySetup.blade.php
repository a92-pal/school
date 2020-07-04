@extends('layouts.adminLayout')
@section('title','Routin Day Setup')
@section('routin')
class="active-menu"
@endsection
@section('headContent')
<script>
 $( function() {
    $( "#datepicker" ).datepicker({ 
        minDate: 0, 
        showAnim:'slideDown',
        beforeShowDay: function(date) {
        var day = date.getDay();
        return [day == 0 ? false : true];
        }
     });
  } );
  </script>
@endsection
@section('content')

<div class="row">
    <h2 style="text-transform:capitalize;" class="col-md-10">Routin Day Setup for Class {{$classSection['class_roman']}}, {{$classSection['section']}}</h2> 
    <a href="{{route('class.routin')}}" class="col-md-2" style="margin-top:20px;">
        <button class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    </a>  
</div>
 <hr/>
 <input type="hidden" id="classSection" value="{{$classSection['id']}}">
 <label for="">Select Date</label><br />
 <input type="text" id="datepicker" class="date" name="day" placeholder="Set routin start day" size="30">
 <div id="result"></div>
<script>
$(document).ready(()=>{
    $('.date').change(function(){
        const id=$('#classSection').val();
        const startDate=$(this).val();
        // alert(id+'=>'+startDate);
        
        $.ajax({
            url:"{{route('routinDayForm')}}",
            method:"post",
            data:{
                "id":id,
                "startDate":startDate
            },
            success:function(res){
                console.log(res);
                $('#result').html(res);
            }
        });

    });
});
</script>

 @endsection