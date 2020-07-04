<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Requests\TeacherEntryRequest;
use App\Attendance;
use App\CustomClass\UserWithAttendance;

class TeacherDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=UserWithAttendance::users('teacher');
        
        return view('admin.userList',compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacherEntryForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherEntryRequest $req)
    {
        $dob=date("Y-m-d H:i:s",(strtotime($req->dob)));
        $pss1=explode('-',date('d-m-Y',strtotime($req->dob)));
        $pss=implode('',$pss1);
        $password=Hash::make($pss);
        $user=User::create([
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'user_type' => 'teacher',
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
                'dob' => $dob,
                'gen' => $req->gender,
                'address' => $req->add,
                'zipcode' => $req->zip,
                'branch' => $req->brnch,
                'qualification' => $req->qualification,
                'blood_group' => $req->bloodGrp ? $req->bloodGrp : null,
                'image' => $fullName
            ]);
        }
        Session::flash('success','Teacher\'s details have been entered successfully. Login password is teacher\'s DOB.');
        return redirect()->back();  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
