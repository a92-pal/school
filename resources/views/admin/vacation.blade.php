@extends('layouts.adminLayout')
@section('title','Vacation Management')
@section('vacation')
class="active-menu"
@endsection
@section('headContent')


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;" class="col-md-10">Vacation Management</h2>   
            <!-- <a href="#" class="col-md-2" style="margin-top:20px;">
                <button class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>   -->
    </div>
</div>

<div style="display:none;" class="showSuccess">
    <div class="alert alert-success">
        Vacation has been saved successfully!
    </div>
</div>

 <hr/>
<form action="javascript:void(0)" method="POST" id="vacationForm">
@csrf
    <div class="row">
        <div class="col-md-4">
            <label for="">Vacation date range</label>
            <input type="text" name="daterange" value="" id="daterange" size="40" class="reqClass" />
        </div>
        <div class="col-md-4">
            <label for="">Purpose</label>
            <input type="text" name="purpose" id="" size="40" placeholder="Description" class="reqClass">
        </div>
        <div class="col-md-4">
            <button class="btn btn-success add" style="margin-top:20px;" size="30">
                <span id="addBtn">Add <i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                <span id="loader" style="display:none;">Adding...</span>
            </button>
        </div>
    </div>
</form>
<hr>

<div>
              
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Vacation Date Range</th>
        <th>Purpose</th>
        <th>Vacation Days</th>
        <th style="width: 150px!important;">Action</th>
      </tr>
    </thead>
    <tbody class="vacationList">
      @if($vacation!=null)
        @foreach($vacation as $v)
            <tr class="respectiveRow">
                <td>{{date('d M, Y',strtotime($v['start_date']))}} - {{date('d M, Y',strtotime($v['end_date']))}}</td> 
                <td>{{$v['duration']}}</td> 
                <td>{{$v['purpose']}}</td> 
                <td>
                    
                    <a href="javascript:void(0)" title="Delete this vacation" class="text-danger" onclick="deleteVacation(this,{{$v['id']}});">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    
                    <span class="text-danger delete_status" style="margin-left: 10px; display:none;">Deleting...</span>
                </td>
            </tr>
        @endforeach
      @endif
      
    </tbody>
  </table>
</div>

<script>
$(document).ready(function(){
    var d=new Date();
    // console.log(d);
    var start_date=d;
    var end_date=d;
    var formSub=true; 
    $('body').on('click','.add',function(){
        formSub=true;
        $('.reqClass').map(function(){
            $(this).css("border","1px solid #ced4da");
            if(this.value.trim() == "") {
                $(this).css("border","solid 1px #dc3545");
                this.focus();
                formSub=false;
            }
            else{
                formSub= this.value && formSub;
 
            }
            
        });
       if(formSub){
            $.ajax({
                url: "{{route('vacation.store')}}",
                type: 'POST',
                data: new FormData(document.getElementById("vacationForm")),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $("#addBtn").hide();
                    $("#loader").show();
                },
                success: function(response){
                    
                    if(response) {
                        $('.reqClass').map(function(){
                            this.value="";
                        });
                        $(".vacationList").append(response.success);
                        showSuccessMessage();
                    }
                },
                complete:function(data){
                    $("#loader").hide();
                    $("#addBtn").show();
                }
            });
       }

        
    });

    function showSuccessMessage(){
        $('.showSuccess').show();
        setTimeout(() => {
                $('.showSuccess').hide()
            }, 2000);
    }


    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'right',   
            "maxSpan": {
                "days": 10
            },
            locale: {
            format: 'DD/MM/YYYY',
            },
            
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY'));
            start_date=start.format('MM/DD/YYYY');
            end_date=end.format('MM/DD/YYYY');
    console.log("start "+ start_date+", end "+end_date);
        });
    });
});
</script>
<script>
function deleteVacation(dis,id)
{
    var closestSection=$(dis).closest(".respectiveRow");
    if(confirm("Are you sure?")){
        
        $.ajax({
            url:"{{url('vacation')}}"+"/"+id,
            type: 'DELETE',
            data: null,
            beforeSend:function(){
                $(".delete_status",closestSection).show();
            },
            success:function(res){
                $(closestSection).remove();

            }
        });

    }
}

// function deleteVacation(dis)
// {
//     var closestSection=$(dis).closest(".respectiveRow");
//     if(confirm("Are you sure?")){
//         $(".delete_status",closestSection).show();
//         $('form',closestSection).submit();
//         $(closestSection).remove();

//     }
// }
</script>


 @endsection