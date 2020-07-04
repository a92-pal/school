@extends('layouts.adminLayout')
@section('title','Routin Management')
@section('routin')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;" class="col-md-10">Routin for Class {{$day['class_roman']}}, Section {{$day['section']}}</h2>   
            <a href="{{route('class.routin')}}" class="col-md-2" style="margin-top:20px;">
                <button class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>  
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
<div style="max-width:100%; overflow-x:scroll;">
<table class="table table-bordered">
    <thead>
      <tr>
        <th style="border-bottom:2px solid #fff; padding:0 15px;">Days</th>
        <th colspan="2" style="text-align:center;">Period 1</th>
        <th colspan="2" style="text-align:center;">Period 2</th>
        <th colspan="2" style="text-align:center;">Period 3</th>
        <th colspan="2" style="text-align:center;">Period 4</th>
        <th colspan="2" style="text-align:center;">Period 5</th>
        <th colspan="2" style="text-align:center;">Period 6</th>
        <th colspan="2" style="text-align:center;">Period 7</th>
        <th colspan="2" style="text-align:center;">Period 8</th>
        <th style="border-bottom:2px solid #fff;">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>  </th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Teacher</th>
        <th></th>
      </tr>
      @foreach($day['routin_days'] as $routinDay)
      <tr>
        <td>Day - {{$routinDay['days']}}</td>
        <form action="{{route('setRoutin')}}" method="post">
            @csrf
            <input type="hidden" value="{{$routinDay['id']}}" name="routinDay">
            @for($i=0;$i<8;$i++)
                @if(isset($routinDay['routins'][$i]))
                    @if($routinDay['routins'][$i]!="")
                      <td class="form-group" >
                        <input type="hidden" value="{{$i+1}}" name="period[]">
                        <input style="width:158px;" type="text" name="{{'sub_'.($i+1)}}" id="" value="{{$routinDay['routins'][$i]['subject']}}" placeholder="Enter Subject Name" class="form-control">
                      </td>
                      <td class="form-group" >
                        <select name="{{'teacher_'.($i+1)}}" id="" class="form-control" style="width:158px;">
                          <option value="" >--Select Teacher--</option>
                          @foreach($teacher as $t)
                            <option value="{{$t['id']}}" {{$routinDay['routins'][$i]['teacher_id']==$t['id']?'selected':null}} >{{$t['name']}} ({{$t['email']}}) </option>
                          @endforeach
                        </select>
                      </td>
                    @else
                      <td class="form-group" >
                        <input type="hidden" value="{{$i+1}}" name="period[]">
                        <input style="width:158px;" type="text" name="{{'sub_'.($i+1)}}" id="" placeholder="Enter Subject Name" class="form-control">
                      </td>
                      <td class="form-group" >
                        <select name="{{'teacher_'.($i+1)}}" id="" class="form-control" style="width:158px;">
                          <option value="" >--Select Teacher--</option>
                          @foreach($teacher as $t)
                            <option value="{{$t['id']}}" >{{$t['name']}} ({{$t['email']}}) </option>
                          @endforeach
                        </select>
                      </td>
                    @endif
                @else
                  <td class="form-group" >
                    <input type="hidden" value="{{$i+1}}" name="period[]">
                    <input style="width:158px;" type="text" name="{{'sub_'.($i+1)}}" id="" placeholder="Enter Subject Name" class="form-control">
                  </td>
                  <td class="form-group" >
                    <select name="{{'teacher_'.($i+1)}}" id="" class="form-control" style="width:158px;">
                      <option value="" >--Select Teacher--</option>
                      @foreach($teacher as $t)
                        <option value="{{$t['id']}}" >{{$t['name']}} ({{$t['email']}}) </option>
                      @endforeach
                    </select>
                  </td>
                @endif
            @endfor
            
            <td><button class="btn btn-success" type="submit">Submit</button></i></td>
        </form>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>
@endsection