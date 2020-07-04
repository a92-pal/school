<hr>
@if($routinDay!=null)
<div class="alert alert-warning">
    Routin start day of this class is already selected for this month. Start day is <strong>Day-{{$routinDay['routin_day']['days']}}</strong> and Date is<strong>{{date("d M, Y",strtotime($routinDay['start_date']))}}</strong><br>
    If you still want to reset, you can submit this form. Else avoid to submit.
</div>
@endif
<div class="row" style="margin-top:50px;">
    <div class="col-md-offset-2 col-md-8">
        <div style="padding:36px; border:1px solid #17381861; border-radius:4px;">
            <form action="{{route('routinDayStore')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">For {{$month}}</label>
                    <input type="hidden" name="classId" value="{{$day['id']}}">
                    <input type="hidden" name="date" value="{{$date}}">
                    <span class="form-control">Start Date {{date("d M, Y",strtotime($date))}}</span>
                </div>
                <div class="form-group">
                    <label for="">Select Routin Start Day</label>
                    <select class="form-control" name="day">
                        @foreach($day['routin_days'] as $day)
                            <option value="{{$day['id']}}">Day {{$day['days']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>