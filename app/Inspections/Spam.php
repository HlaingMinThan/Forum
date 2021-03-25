<?php 
namespace App\Inspections;

class Spam
{
    //register inspections class here
   protected $inspections=[
       SpamKeywords::class, 
       KeyDuplications::class
   ];

    public function detect($body){
        foreach($this->inspections as $inspection){
            (new $inspection)->detect($body);
        }
        return false;//if there is no spam return false,if there is it'll throw new exception
    }
    
}
