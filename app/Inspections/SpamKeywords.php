<?php 

namespace App\Inspections;

use Exception;

class SpamKeywords{

    protected $spamKeywords=[
        'fuck you',
    ];
    
    public function detect($body){
        foreach($this->spamKeywords as $keyword){
            if(str_contains($body,$keyword)){ //check reply body contain in spam keywords
                // abort(422,"we don't allow spam");
                throw new Exception("We don't allow spam");
            }
        }
    }
}