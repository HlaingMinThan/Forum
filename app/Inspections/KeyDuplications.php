<?php 

namespace App\Inspections;

class KeyDuplications{

    public function detect($body){
        if(preg_match('/(.)\\1{4}/',$body,$matches)){
            abort(403);
        }
    }
    
}