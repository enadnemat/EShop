<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;
use Notification;


class NotificationController extends Controller
{

    public function index()
    {
        //dd(\auth()->user()->email);
        return view('home');
    }

    public function updateDeviceToken(Request $request)
    {
        dd($request->all());

        auth()->user()->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('device_token')->pluck('device_token')->all();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->body)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('success', 'Notification Sent Successfully!!');

        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }
}
