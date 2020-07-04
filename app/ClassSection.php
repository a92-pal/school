<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RoutinDay;
use App\RoutinStartDay;

class ClassSection extends Model
{
    protected $fillable=['class','section'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function routinDays()
    {
        return $this->hasMany(RoutinDay::class);
    }

    public function routinStartDays()
    {
        return $this->hasMany(RoutinStartDay::class);
    }
}
