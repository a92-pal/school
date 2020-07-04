<?php

namespace App\CustomClass;

use App\User;

class UserWithAttendance
{
    public static function users($type)
    {
        $users=User::with('userDetail','attendances','classSection')->where('user_type',$type)->get()->toArray();

        $countPresent=User::with('attendances')->with(['attendances'=>function($q){
            $q->where('attendance','1');
        }])->where('user_type',$type)->get()->toArray();
        
        $presentPercentage=[];
        for($i=0;$i<sizeof($users);$i++)
        {
            $present=sizeof($countPresent[$i]['attendances']);
            $totalDays=sizeof($users[$i]['attendances']);
            
            if($totalDays!=null){
                $presentPercentage[$i]=($present/$totalDays)*100;
            } else {
                $presentPercentage[$i]=null;
            }
        }

        return ['users'=>$users,'present'=>$presentPercentage];
        
    }

    public static function userDetailWithAttendance($id)
    {
        $person=User::with('userDetail','attendances')->where('id',$id)->firstOrFail()->toArray();

        $count=User::with('attendances')->with(['attendances'=>function($q){
            $q->where('attendance','1');
        }])->where('id',$id)->firstOrFail()->toArray();

        $present=sizeof($count['attendances']);
        $absent=sizeof($person['attendances'])-$present;

        return ['person'=> $person,'present'=>$present,'absent'=>$absent];
    }

}

?>