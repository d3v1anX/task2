<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\NewUpdateProduct;

class SendNotifyController extends Controller
{
    //

    public function index(Request $request)
    {
        $teamleaders = User::whereHas("roles", function($q){ $q->where("name", "TeamLeader"); })->get();
  
       // Notification::sendNow($teamleaders, new NewUpdateProduct());
        foreach($teamleaders as $user){
        $user->notify(new NewUpdateProduct);
        }

        // foreach($teamleaders as $user){

        //     $messages["hi"] = "Hey, Happy Birthday {$user->name}";
        //     $messages["wish"] = "On behalf of the entire company I wish you a very happy birthday and send you my best wishes for much happiness in your life.";
              
        //     $user->notify(new BirthdayWish($messages));

        // }
       
  
        dd('Done');
    }

}
