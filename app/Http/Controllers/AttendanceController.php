<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\ClassSection;
use App\Attendance;
use App\User;

class AttendanceController extends Controller
{
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $class = ClassSection::get()->toArray();
            
            return view('admin.allClassesInAttendance', compact('class'));
        } else {
            abort(404);
        }
    }

    public function teacherIndex()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.attendance');
        } else {
            abort(404);
        }
    }

    public function attendanceDateSelect($id)
    {
        if (Gate::allows('isAdmin')) {
            $students = ClassSection::where('id',$id)->firstOrFail()->toArray();
            
            return view('admin.attendance', compact('students'));
        } else {
            abort(404);
        }
    }

    public function attendanceForm(Request $req)
    {
        if (Gate::allows('isAdmin')) {
            if($req['id']==null){
                return  $this->teacherAttendanceForm($req);
            } else {
                return $this->studentAttendanceForm($req);
            }
            
        } else {
            abort(404);
        }
    }

    public function storeAttendance(Request $req)
    {
        switch($req->editAttendance){
            case '1':
                return $this->editAttendance($req);
            default:
                return $this->addAttendance($req);
        }
             
    }
    
    protected function studentAttendanceForm($req)
    {
        $date = $req['attndDate'];
        $dateFind=date("Y-m-d H:i:s",(strtotime($date)));
       
        $persons =ClassSection::with('users.userDetail')->with(['users.attendances'=> function($q) use ($dateFind){
                $q->whereDate('date','=',$dateFind);
            }])->whereHas('users',function($qu){
                $qu->where('user_type','student');
            })->find($req['id'])->toArray();
        
        // fetching class students through ajax
        return view('admin.attendanceForm', compact('date', 'persons'));

    }

    protected function teacherAttendanceForm($req)
    {
        $date = $req['attndDate'];
        $dateFind=date("Y-m-d H:i:s",(strtotime($date)));
        $persons=[];
        $users =User::with('userDetail')->with(['attendances'=>function($q) use ($dateFind){
            $q->whereDate('date', $dateFind);
        }])->where('user_type','teacher')->get()->toArray();
        $persons['users']=$users;
        
        // fetching Teachers through ajax
        return view('admin.attendanceForm', compact('date', 'persons'));
        
    }

    protected function addAttendance($req)
    {
        foreach($req->user_id as $user)
        {
            $user_attendance='attend_'.$user;
         
            $attendance=new Attendance();
            $attendance->user_id=$user;
            $attendance->attendance=$req->$user_attendance;
            $attendance->date=date("Y-m-d H:i:s",(strtotime($req->date)));
            $attendance->save();
        }
        return $this->userType($req->user_id[0]);
        
    }

    protected function editAttendance($req)
    {
        for($i=0;$i<sizeof($req->user_id);$i++)
        {
            $user_attendance='attend_'.$req->user_id[$i];
            $attendance=Attendance::find($req->prevAttn[$i])->update(['attendance' => $req->$user_attendance]);
        }
        return $this->userType($req->user_id[0]);
    }

    protected function userType($typeId)
    {
        $type=User::select('user_type')->find($typeId);
        switch ($type){
            case 'student':
                return redirect()->route('class.attendance')->with('success','Attendace was saved successfully.');
            default:
                return redirect()->route('home')->with('success','Attendace was saved successfully.');
        }
    }
}
