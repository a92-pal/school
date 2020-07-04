@extends('layouts.adminLayout')
@section('title',$res['person']['name'].'\'s Profile')
@section('staffStudent')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-10">
            <h2 style="text-transform:capitalize;">{{$res['person']['name']}}'s Profile</h2>   
    </div>
</div>              
<hr />
<div class="row" style="margin:10px;">
    <div class="col-md-6" style="padding-left: 0;">
        <div style="background:#c8cac8; text-align:center; height:250px; border-radius:5px; ">
            <img src="{{asset($res['person']['user_detail']['image'])}}" alt="" class="img-thumbnail" style="position: absolute; left: 50%; top: 50%;transform: translate(-50%, -50%);">
        </div>
    </div>
    <div class="col-md-6">
        <input type="hidden" id="present" value="{{$res['present']}}">
        <input type="hidden" id="absent" value="{{$res['absent']}}">
        <div id="piechart" style="position:absolute; top:-17px;"></div>
    </div>
</div>

<div class="row" style="margin: 20px -6px;">
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Name :</strong> {{$res['person']['name']}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Blood Group :</strong> {{$res['person']['user_detail']['blood_group']?$res['person']['user_detail']['blood_group']:'Not Mentioned'}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Gender :</strong> {{$res['person']['user_detail']['gen']==0?'Male':'Female'}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>DOB :</strong> {{$res['person']['user_detail']['dob']}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Address :</strong> {{$res['person']['user_detail']['address']}}, 
                <strong>Zipcode :</strong> {{$res['person']['user_detail']['zipcode']}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Contact No :</strong> {{$res['person']['phone']}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Email :</strong> {{$res['person']['email']}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background:#fbf786; width:100%; padding:15px; border-radius:5px; margin:5px 10px 2px 0px;">
            <div style="/*background:#fff;*/ width:100%; padding:5px;">
                <strong>Qualification :</strong> {{$res['person']['user_detail']['qualification']}}
            </div>
        </div>
    </div>

</div>
@endsection
@section('footerContent')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){

        var present=parseInt($('#present').val());
        var absent=parseInt($('#absent').val());
        
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    
        // Draw the chart and set the chart values
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Task', 'Attendance'],
        ['Present', present],
        ['Absent', absent],
        
        ]);
    
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title':'Attendance Percentage',
            is3D: true, 
            'width':468,
            'height':317,
            slices: {
                0: { color: 'green' },
                1: { color: 'grey' }
            }
        };
    
        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        }
    });
    </script>
@endsection