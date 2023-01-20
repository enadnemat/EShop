<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;
use Notification;


class NotificationController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function updateDeviceToken(Request $request)
    {
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('device_token')->pluck('device_token')->toArray();
            //dd($fcmTokens);
            //Notification::send(null, new SendPushNotification($request->title, $request->message, $fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($request->title,$request->body,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('success', 'Notification Sent Successfully!!');

        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }
}
