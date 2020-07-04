<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use App\ClassSection;
use Gate;
use Auth;
use Carbon\Carbon;
use App\Events\UpdateAdminDashboardEvent;
use Pusher\Pusher;
use App\Visitor;
use App\CustomClass\realtimeActivity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isTeacher')){
            $user=User::with('userDetail')->find(Auth::user()->id)->toArray();
            $start_date=strtotime($user['user_detail']['dob']);
            $end_date=strtotime(Carbon::now());
            $age=intval(($end_date - $start_date)/60/60/24/365);
            return view('home',compact('user','age'));
        }

        if(Gate::allows('isStudent')){
            $user=User::with('userDetail','classSection')->find(Auth::user()->id)->toArray();
            $start_date=strtotime($user['user_detail']['dob']);
            $end_date=strtotime(Carbon::now());
            $age=intval(($end_date - $start_date)/60/60/24/365);
            return view('home',compact('user','age'));
        }
        if(Gate::allows('isAdmin')){
            $students=User::where('user_type','student')->count();
            $teachers=User::where('user_type','teacher')->count();
            // dd($students);
            // event(new UpdateAdminDashboardEvent('data'));
            
            realtimeActivity::adminDashboardHandler();

            return view('home',compact('students','teachers'));
        }
    }
}
