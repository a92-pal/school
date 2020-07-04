<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClassSection;
use App\Routin;
use App\RoutinStartDay;

class RoutinDay extends Model
{
    protected $guarded=['id','created_at','updated_at'];

    public function classSection()
    {
        return $this->belongsTo(ClassSection::class);
    }

    public function routins()
    {
        return $this->hasMany(Routin::class);
    }

    public function routinStartDay()
    {
        return $this->hasOne(RoutinStartDay::class);
    }
}
