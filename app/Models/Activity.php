<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subject()
    {
        return $this->morphTo();
    }
    public static function getAllActivitiesFrom($user)
    {
        return $user->activities()->with('subject')->take(20)->latest()->get()->groupBy(function ($activity) {
            return $activity->created_at->format("M-d-Y");
        });
    }
}
