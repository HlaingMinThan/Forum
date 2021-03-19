<?php  

namespace App;

use App\Models\Activity;
use ReflectionClass;

Trait RecordsActivity{

    protected static function booted()//bootRecordsActivity
    {
       foreach(static::getEvents() as $event){
        static::created(function($thread) use ($event){
            $thread->recordActivity($event);
        });
       }
    }
    protected static function getEvents(){
        return ['created'];
    }
    protected function recordActivity($eventType){
        // Activity::create([
        //     "user_id"=>auth()->id(),
        //     "subject_id"=>$this->id,
        //     "subject_type"=>get_class($this),
        //     "type"=>$this->activityType($eventType)
        // ]);
        $this->activity()->create([
            "user_id"=>auth()->id(),
            "type"=>$this->activityType($eventType)
        ]);
    }
    public function activity(){
        return $this->morphMany(Activity::class,'subject');//a thread has morph many activities
    }
    public function activityType($event){
        $className=strtolower((new ReflectionClass($this))->getShortName());
        return "{$event}_{$className}"; //created_thread
    }
}