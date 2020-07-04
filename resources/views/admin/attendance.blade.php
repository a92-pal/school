@extends('layouts.adminLayout')
@section('title',isset($students) ? 'Students Attendance Management' : 'Teachers Attendance Management')
@section('staffStudent')
class="active-menu"
@endsection
@section('headContent')
<script>
 $( function() {
    $( "#datepicker" ).datepicker({ 
        maxDate: 0, 
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
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;">
                @if(isset($students))
                    Attendance of class {{$students['class_roman']}}, section {{$students['section']}}
                @else
                    Teachers' Attendance
                @endif
            </h2>   
    </div>
</div>
 <hr/>
 <input type="hidden" id="classSection" value="{{isset($students) ? $students['id'] : ''}}">
 <label for="">Attendance Date</label><br />
 <input type="text" id="datepicker" class="attendanceDate" name="day" placeholder="Select the date of Attendance" size="30">
 <div id="result"></div>
<script>
$(document).ready(()=>{
    $('.attendanceDate').change(function(){
        const id=$('#classSection').val();
        const attnDate=$(this).val();
        // alert(id+'=>'+attnDate);
        
        $.ajax({
            url:"{{route('attendance')}}",
            method:"post",
            data:{
                "id":id,
                "attndDate":attnDate
            },
            success:function(res){
                // console.log(res);
                $('#result').html(res);
            }
        });

    });
});
</script>
@endsection