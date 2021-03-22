<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends Controller
{
   public function store($channelSlug,Thread $thread){

      $thread->subscribe();

   }
     
   public function destroy($channelSlug,Thread $thread){

      $thread->unSubscribe();
   
   }
}
