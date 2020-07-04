<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\ClassSection;
use App\RoutinDay;
use App\User;
use App\Routin;
use Session;
use Auth;
use App\RoutinStartDay;

class RoutinDayController extends Controller
{
    public function index()
    {
        if(Gate::allows('isAdmin')){
            $class=ClassSection::get()->toArray();
            // dd($class);
            return view('admin.allClassesInRoutin',compact('class'));
        }
        else{
            abort(404);
        }
    }

    public function classForm($id)
    {
        if(Gate::allows('isAdmin')){
            $day=ClassSection::with('routinDays.routins')->find($id)->toArray();
            // dd($day);
            $teacher=User::where('user_type','teacher')->get()->toArray();
            return view('admin.setRoutin',compact('day','teacher'));
        }
    }

    public function setRoutin(Request $req)
    {
        // dd($req->all());
        foreach($req->period as $prd)
        {
            $routin=Routin::where('routin_day_id',$req->routinDay)->where('period',$prd)->first();
            // dd($routin);
            if($routin===null)
            {
                $sub='sub_'.$prd;
                $teacher='teacher_'.$prd;
                if($req->$sub && $req->$teacher)
                {
                    // dd('Null');
                    $createRoutin=new Routin();
                    $createRoutin->routin_day_id=$req->routinDay;
                    $createRoutin->period=$prd;
                    $createRoutin->subject=$req->$sub;
                    $createRoutin->teacher_id=$req->$teacher;
                    $createRoutin->save();
                    
                }
            }
            else
            {
                $sub='sub_'.$prd;
                $teacher='teacher_'.$prd;
                if($req->$sub && $req->$teacher)
                {
                    // dd('Not Null');
                    $routin->routin_day_id=$req->routinDay;
                    $routin->period=$prd;
                    $routin->subject=$req->$sub;
                    $routin->teacher_id=$req->$teacher;
                    $routin->save();
                }
            }
        }
        return back()->with('success','Routin has been saved!');
    }

    public function teacherRoutin()
    {
        if(Gate::allows('isTeacher')){
            $id=Auth::user()->id;
            // $res=Routin::with(['routinDays'])->where('teacher_id',$id)->get()->sortBy('routinDays.days')->toArray();

            $result=Routin::with(['routinDays.classSection'])->where('teacher_id',$id)->get()->groupBy('routinDays.days')->toArray();

            // $res=Routin::where('teacher_id',$id)->get();
            // $res->load(['routinDays'=>function($q){
            //         $q->orderBy('id','desc');
            //     }])->toArray();
            // dump($result);
            return view('teacher.routin',compact('result'));
        }
    }

    public function classesScheduleViewForAll()
    {
        $class=ClassSection::get()->toArray();

        return view('allClassesInRoutin',compact('class'));
    }

    public function classSchedule($id)
    {
        $class=ClassSection::where('id',$id)->firstOrFail()->toArray();
        // dd($class);
        return view('classSchedule',compact('class'));
    }

    public function schedule(Request $req)
    {
        $result=RoutinStartDay::with('routinDay')->where('class_section_id',$req['class'])->where('month',$req['month'])->first();
        if($result!=null){
            $routin=$this->arrangeRoutin($req['class']);
            // dd($routin);
            $firstDay=date("01-m-Y", strtotime($result->start_date));
            $lastDay=date("t-m-Y", strtotime($result->start_date));
            $res=$result->toArray();

            return view('subClassSchedule',compact('res','lastDay','firstDay','routin'));
        }
        $div="<div class='text-secondary text-center mt-4'><h1>Not Available!</h1></div>";

        return response()->json($div);
    }

    protected function arrangeRoutin($id)
    {
        $routin=RoutinDay::with('routins')->where('class_section_id',$id)->get()->toArray();
        for($i=0;$i<sizeof($routin);$i++)
        {
            // array_push($res,$routin[$i]['days']=>$routin[$i]['routins']);
            $res['day-'.$routin[$i]['days']]=$routin[$i]['routins'];
        }
        return $this->getTeachers($res);
    }

    protected function getTeachers($res)
    {
        foreach($res as $key=>$r)
        {
            for($i=0;$i<sizeof($r);$i++)
            {
                $teacher=User::find($r[$i]['teacher_id'])->name;
                $r[$i]['teacher']=$teacher;
            }
            $result[$key]=$r;
        }
        return $result;
    }

    public function routinDaySetup($id)
    {
        if(Gate::allows('isAdmin'))
        {
            $classSection=ClassSection::where('id',$id)->firstOrfail()->toArray();
            return view("admin.RoutinDaySetup",compact('classSection'));
        }
        else{
            abort(404);
        }
    }

    public function routinDayForm(Request $req)
    {
        $classSection=$req['id'];
        $day=ClassSection::with('routinDays')->where('id',$classSection)->firstOrFail()->toArray();
        $date=$req['startDate'];
        $month=date("M",strtotime($req['startDate']));
        $routinStartDay=RoutinStartDay::with('routinDay')->where('class_section_id',$classSection)->where('month',$month)->first();
        $routinDay=$routinStartDay?$routinStartDay->toArray():NULL;
        
        return view('admin.routinStartDayForm',compact('day','date','month','routinDay'));
    }

    public function routinDayStore(Request $req)
    {
        $validData=$req->validate([
            "classId" => 'required',
            "date" => "required|date",
            "day" => "required"
        ]);

        $month=date("M",strtotime($req->date));

        $routinStartDay=RoutinStartDay::where('class_section_id',$req->classId)->where('month',$month)->first();
        if($routinStartDay==null){
            $routinStartDay=new RoutinStartDay();
        }
        
        return $this->storeRoutinDay($routinStartDay,$req);
        
    }

    protected function storeRoutinDay($routinStartDay,$req)
    {
        $routinStartDay->class_section_id=$req->classId;
        $routinStartDay->month=date("M",strtotime($req->date));
        $routinStartDay->start_date=date("Y-m-d H:i:s",strtotime($req->date));
        $routinStartDay->start_routin_day=$req->day;
        $routinStartDay->save();
        return redirect()->route('class.routin')->with('success','Routin start Day has been set.');
    }
}
