<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClassSection;
use App\RoutinDay;

class RoutinStartDay extends Model
{
    protected $guarded=['id','created_at','updated_at'];
    
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class);
    }

    public function routinDay()
    {
        return $this->belongsTo(RoutinDay::class,"start_routin_day");
    }
}
