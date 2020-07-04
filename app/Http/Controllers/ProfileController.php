<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Auth;
use App\UserDetail;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeTeacherPassword(Request $req)
    {
        // dd($req->all());
            $req->validate([
                'oldPassword' => 'required',
                'newPassword' => 'required|min:6|same:confirmedPassword',
            ]);
        if(!(Hash::check($req->oldPassword,Auth::user()->password)))
        {
            return back()->with('error','Your old password is not matched with the given entered password.');
        }
        if(strcmp($req->oldPassword,$req->newPassword)==0)
        {
            return back()->with('error','You can not give your old password as your new password.');
        }
        $user=Auth::user();
        $user->password=bcrypt($req->newPassword);
        $user->save();
        return back()->with('success','You have successfully changed your password.');

    }

    public function changeStudentPassword(Request $req)
    {
        //  dd($req->all());
         $req->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|same:confirmedPassword',
        ]);
        if(!(Hash::check($req->oldPassword,Auth::user()->password)))
        {
            return back()->with('error','Your old password is not matched with the given entered password.');
        }
        if(strcmp($req->oldPassword,$req->newPassword)==0)
        {
            return back()->with('error','You can not give your old password as your new password.');
        }
        $user=Auth::user();
        $user->password=Hash::make($req->newPassword);
        $user->save();
        return back()->with('success','You have successfully changed your password.');
    }

    public function changeTeacherImage(Request $req)
    {
        // dd($req->all());
        $user=UserDetail::where('user_id',Auth::user()->id)->first();
        $imageLink=$user->image;
        $image=time().$req->image->getClientOriginalName();
        $dir="allImages/";
        $fullName=$dir.$image;
        $success=$req->image->move($dir,$image);
        if($success)
        {
            $user->image=$fullName;
            $user->save();
            unlink(public_path($imageLink));
        }
        return back()->with('success',"You have successfully changed your image.");
    }

    public function changeStudentImage(Request $req)
    {
        // dd($req->all());
        $user=UserDetail::where('user_id',Auth::user()->id)->first();
        $imageLink=$user->image;
        $image=time().$req->image->getClientOriginalName();
        $dir="allImages/";
        $fullName=$dir.$image;
        $success=$req->image->move($dir,$image);
        if($success)
        {
            $user->image=$fullName;
            $user->save();
            unlink(public_path($imageLink));
        }
        return back()->with('success',"You have successfully changed your image.");
    }
}
