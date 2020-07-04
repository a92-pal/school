<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Illuminate\Http\Request;
use App\ClassSection;
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\Events\NewUserHasRegisteredEvent as RegistrationEvent;
use App\Http\Requests\StudentEntryRequest;
use App\CustomClass\UserWithAttendance;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=UserWithAttendance::users('student');
        
        return view('admin.userList',compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class=ClassSection::get()->toArray();
        // dd($class);
        return view('admin.studentEntryForm',compact('class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentEntryRequest $req)
    {
        $userReg=User::where('reg_no','!=',NULL)->latest()->first();
        if($userReg==null){
            $reg='SM/00001';
        }
        else{
            $u=(int)explode('/',$userReg->reg_no)[1];
            $reg='SM/'.sprintf('%05d',($u+1));;
            
        }

        // dd($reg);
        $dob=date("Y-m-d H:i:s",(strtotime($req->dob)));
        $pss1=explode('-',date('d-m-Y',strtotime($req->dob)));
        $pss=implode('',$pss1);
        $password=Hash::make($pss);
        $user=User::create([
            'name' => $req->name,
            'class_section_id'=>$req->class,
            'phone' => $req->phone,
            'reg_no' => $reg,
            'user_type' => 'student',
            'password' => $password,
        ]);

        $img=time().$req->image->getClientOriginalName();
        $dir='allImages/';
        $fullName=$dir.$img;
        $success=$req->image->move($dir,$img);
        if($success)
        {
            $userDetail=UserDetail::create([
                'user_id' => $user->id,
                'roll' => $req->roll,
                'dob' => $dob,
                'gen' => $req->gender,
                'address' => $req->add,
                'zipcode' => $req->zip,
                'branch' => $req->brnch,
                'blood_group' => $req->bloodGrp ? $req->bloodGrp : null,
                'image' => $fullName
            ]);
        }
        Session::flash('success','Student\'s details have been entered successfully. Reg ID is '.$reg.'. Login password is student\'s DOB.');
        event(new RegistrationEvent($user,$userDetail));
        
        return redirect()->back();        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res=UserWithAttendance::userDetailWithAttendance($id);
        
        return view('admin.userShow',compact('res'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $userDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetail $userDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }

    public function rollInfo(Request $req)
    {
        // dd($req->all());
       
        $findRoll=DB::Select("SELECT MAX(user_details.roll) as roll FROM class_sections INNER JOIN users ON class_sections.id=users.class_section_id INNER JOIN user_details ON users.id=user_details.user_id where class_sections.id='".$req['id']."'");
        $roll=$findRoll[0];
        // dd($roll);
        return response()->json($roll);
    }
}
