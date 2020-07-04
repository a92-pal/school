<h3>Attendance on {{$date}}</h3>
<form action="{{route('store.attendance')}}" method="post">
    @csrf
    <input type="hidden" name="date" value="{{$date}}">
    @if($persons['users'][0]['attendances'] != null)
        <input type="hidden" name="editAttendance" value="1">
    @else
        <input type="hidden" name="editAttendance" value="0">        
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Name of the Student</th>
                <th>{{$persons['users'][0]['user_type'] == 'student' ? 'Roll' : 'Phone'}}</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>
        </thead>
        <tbody>
        <?php $c=1; ?>
        @foreach($persons['users'] as $user)
            <tr>
            <input type="hidden" name="user_id[]" value="{{$user['id']}}">
                <td>{{$c++}} .</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['user_type']=='student' ? $user['user_detail']['roll'] : $user['phone']}}</td>
                @if($user['attendances'] != null)
                    <input type="hidden" name="prevAttn[]" value="{{$user['attendances'][0]['id']}}">
                    <td><input type="radio" name="{{'attend_'.$user['id']}}" value="1" {{$user['attendances'][0]['attendance']==1?'checked':''}}></td>
                    <td><input type="radio" name="{{'attend_'.$user['id']}}" value="0" {{$user['attendances'][0]['attendance']==0?'checked':''}} ></td>
                @else
                    <td><input type="radio" name="{{'attend_'.$user['id']}}" value="1"></td>
                    <td><input type="radio" name="{{'attend_'.$user['id']}}" value="0" checked ></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="submit" class='btn btn-success' style="float:right; margin-right:10px;">Submit</button>
</form>