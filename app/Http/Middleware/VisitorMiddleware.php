<?php

namespace App\Http\Middleware;

use Closure;
use App\Visitor;
use Carbon\Carbon;
use App\User;
use App\Events\UpdateAdminDashboardEvent;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->counting();
        // $this->realtimeActivityOnAdminDashboard();
        return $next($request);
    }

    protected function counting()
    {
        $time = Carbon::now()->timestamp;
        $check=Visitor::find(1);
        if($check!=null)
        {
            $count=Visitor::whereDate('created_at',date('Y-m-d',$time))->first();
            
            if($count==null) $this->newCount();
            else $this->updateCount($count);
         
        }
        else $this->newCount();

        $this->finalCount();
    }

    protected function updateCount($count)
    {
        $newCount=$count->visitors+1;
        $count->visitors=$newCount;
        $count->save();
    }

    protected function newCount()
    {
        Visitor::create(['visitors'=>1]);
    }

    protected function finalCount()
    {
        $finalCount=Visitor::sum('visitors');  
        define('VISITORS',$finalCount);
        // return $finalCount;
    }

    protected function realtimeActivityOnAdminDashboard()
    {
        $totalStudents=User::where('user_type','student')->count();
        $totalTeachers=User::where('user_type','teacher')->count();
        $visitors=$this->finalCount();
        $data=['students'=>$totalStudents,"teachers"=>$totalTeachers,"visitors"=>$visitors];
        // event(new UpdateAdminDashboardEvent($data));
    }
}
