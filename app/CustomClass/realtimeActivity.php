<?php

namespace App\CustomClass;

use Pusher\Pusher;
use App\Visitor;
use App\User;

class realtimeActivity
{
    public static function adminDashboardHandler()
    {
        $students=User::where('user_type','student')->count();
        $teachers=User::where('user_type','teacher')->count();

        $visitors=Visitor::sum('visitors'); 
        $data=['students'=>$students,"teachers"=>$teachers,"visitors"=>$visitors];
        $options = array (
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher =new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('realtime-count','my-event',$data);
    }
}

?>