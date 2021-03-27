<?php

namespace App;

use App\Models\Activity;
use ReflectionClass;

trait RecordsActivity
{
    protected static function bootRecordsActivity()//bootRecordsActivity
    {
        if (auth()->guest()) {
            return;
        }
        foreach (static::getEvents() as $event) {
            static::created(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
        static::deleting(function ($model) {
            $model->activities()->delete(); // activity method is tn in the  Recordsactivity trait
        });
    }
    protected static function getEvents()
    {
        return ['created'];
    }
    protected function recordActivity($eventType)
    {
        $this->activities()->create([
            "user_id"=>auth()->id(),
            "type"=>$this->activityType($eventType)
        ]);
    }
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');//a (thread,reply,favorite) has morph many activities
    }
    public function activityType($event)
    {
        $className=strtolower((new ReflectionClass($this))->getShortName());
        return "{$event}_{$className}"; //created_thread
    }
}
