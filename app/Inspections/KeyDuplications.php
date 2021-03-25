<?php 

namespace App\Inspections;

use Exception;

class KeyDuplications{

    public function detect($body){
        if(preg_match('/(.)\\1{4}/',$body,$matches)){
            // abort(422,"we don't allow spam");
            throw new Exception("We don't allow spam");
        }
    }
    
}