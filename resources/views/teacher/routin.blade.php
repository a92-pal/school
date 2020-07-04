@extends('layouts.adminLayout')
@section('title','Class Schedules')
@section('routin')
class="active-menu"
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;">Class Schedules</h2>   
    </div>  
    @if(Session::get('success'))
    <div class="col-md-12 alert alert-success" style="margin:0 25px; width: 95%;">
        {{Session::get('success')}} <span class="close" style="color: #ff0000;"><strong>x</strong> </span>
    </div> 
    <script>
        $(document).ready(function(){
            $('body').on('click','.close',function(){
                $('.alert').hide();
            });
        })
    </script>
    @endif
</div>              
<!-- /. ROW  -->
<hr />
<div style="max-width:100%; overflow-x:scroll;">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Days</th>
        <th style="text-align:center;">Period 1</th>
        <th style="text-align:center;">Period 2</th>
        <th style="text-align:center;">Period 3</th>
        <th style="text-align:center;">Period 4</th>
        <th style="text-align:center;">Period 5</th>
        <th style="text-align:center;">Period 6</th>
        <th style="text-align:center;">Period 7</th>
        <th style="text-align:center;">Period 8</th>

      </tr>
    </thead>
    <tbody>
      @foreach($result as $id=>$days)
        <tr>
            <td style="text-align:center;">{{$id}}</td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==1)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==2)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==3)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==4)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==5)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==6)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==7)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
            <td style="text-align:center;">
            <?php $sub="<span class='text-muted'>No Class</span>"; ?>
                @foreach($days as $day)
                    @if($day['period']==8)
                        <?php $sub="<strong style='color:#0580ea;'>".$day['subject'].'<br>Class '.$day['routin_days']['class_section']['class_roman'].','.$day['routin_days']['class_section']['section']."</strong>"; ?>
                        
                        @break
                    @endif
                @endforeach
                {!!$sub!!}
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection