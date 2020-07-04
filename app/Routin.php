<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RoutinDay;

class Routin extends Model
{
    protected $guarded=['id','created_at','updated_at'];

    public function routinDays()
    {
        return $this->belongsTo(RoutinDay::class,'routin_day_id');
    }
}
