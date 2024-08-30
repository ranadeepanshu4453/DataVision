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


    public function read($id){
        $notification = auth()->user()->notifications->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }
        return back();
        

    }
}
