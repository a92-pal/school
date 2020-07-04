@extends('layouts.adminLayout')
@section('title', $res['users'][0]['reg_no']==null ? 'Teachers' : 'Students')
@section('staffStudent')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-10">
            <h2 style="text-transform:capitalize;">{{$res['users'][0]['user_type']=='teacher' ? 'Teachers\'' : 'Students\''}} Lists</h2>   
    </div>
    <div class="col-md-2">
    <?php $route=$res['users'][0]['reg_no']==null ? 'teacher.create' : 'student.create'; ?>
        <a href="{{route($route)}}"><button class="btn btn-success" style="margin-top:26px;">Entry Form</button></a>
    </div>
</div>              
        <!-- /. ROW  -->
<hr />

<table id="myTable">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
              @if($res['users'][0]['reg_no']==null)
              <th>Email </th>
              @else
              <th>Class</th>
              <th>Section</th>
              <th>Roll No</th>
              @endif
            <th>Contact No.</th>
            <th>Attendance</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=0; ?>
        @foreach($res['users'] as $users)
        <tr>
            <td><img src="{{$users['user_detail']['image']}}" alt="" height="70" width="80"></td>
            <td>{{$users['name']}}</td>
              @if($users['reg_no']==null)
                <td>{{$users['email']}}</td>
              @else
                <td>{{$users['class_section']['class_roman']}}</td>
                <td>{{$users['class_section']['section']}}</td>
                <td>{{$users['user_detail']['roll']}}</td>
              @endif
            <td>{{$users['phone']}}</td>
            <td>
              <strong>{{$res['present'][$count]!= null ? number_format($res['present'][$count]).'%' : 'Not Initiated'}} </strong>
            </td>
            <td>
              <label class="switch">
                  <input class="switch-input" type="checkbox" {{$users['status']==1?'checked':''}}/>
                  <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span>
              </label>
            </td>
            <td>
              @if($users['user_type']=='teacher')
                <a href="{{route('teacher.show',[$users['id']])}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                <a href="{{route('teacher.edit',[$users['id']])}}" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
              @else
                <a href="{{route('student.show',[$users['id']])}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                <a href="{{route('student.edit',[$users['id']])}}" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
              @endif
            </td>
        </tr>
        <?php $count++; ?>
        @endforeach
    </tbody>
</table>





@endsection
@section('headContent')

<!-- data table plugins -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" ></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>

<style>
    .switch {
      position: relative;
      display: block;
      vertical-align: top;
      width: 60px;
      height: 18px;
      padding: 3px;
      margin: 0 10px 10px 0;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
      border-radius: 18px;
      box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
      cursor: pointer;
    }
    .switch-input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }
    .switch-label {
      position: relative;
      display: block;
      height: inherit;
      font-size: 10px;
      text-transform: uppercase;
      background: #eceeef;
      border-radius: inherit;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
    }
    .switch-label:before, .switch-label:after {
      position: absolute;
      top: 50%;
      margin-top: -.5em;
      line-height: 1;
      -webkit-transition: inherit;
      -moz-transition: inherit;
      -o-transition: inherit;
      transition: inherit;
    }
    .switch-label:before {
      content: attr(data-off);
      right: 11px;
      color: #aaaaaa;
      text-shadow: 0 1px rgba(255, 255, 255, 0.5);
    }
    .switch-label:after {
      content: attr(data-on);
      left: 10px;
      color: #FFFFFF;
      text-shadow: 0 1px rgba(0, 0, 0, 0.2);
      opacity: 0;
    }
    .switch-input:checked ~ .switch-label {
   	  background: #029c2a;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
    .switch-input:checked ~ .switch-label:before {
      opacity: 0;
    }
    .switch-input:checked ~ .switch-label:after {
      opacity: 1;
    }
    .switch-handle {
      position: absolute;
      top: 4px;
      left: 4px;
      width: 18px;
      height: 18px;
      background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
      background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
      border-radius: 100%;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    }
    .switch-handle:before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -6px 0 0 -6px;
      width: 12px;
      height: 12px;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
      border-radius: 6px;
      box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
    }
    .switch-input:checked ~ .switch-handle {
      left: 40px;
      box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
    }
    /* Transition
        ========================== */
    .switch-label, .switch-handle {
      transition: All 0.3s ease;
      -webkit-transition: All 0.3s ease;
      -moz-transition: All 0.3s ease;
      -o-transition: All 0.3s ease;
    }
    
</style>
@endsection