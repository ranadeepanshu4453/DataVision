<?php

namespace App\Http\Controllers;

use App\Notifications\ImportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    // public function sendNotification(){
    //     $user=Auth::user();

    //     $user->notify(new ImportNotification("title","message"));
    // }
}
