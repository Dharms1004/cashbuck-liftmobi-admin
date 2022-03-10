<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Offer;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\firebase;
use Log;

class PushNotification extends Controller
{
    use Firebase;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),  [
                'heading' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('pushNotification')
                    ->withErrors($validator)
                    ->withInput();
            }

            $token= DB::table('users')->whereNotNull('FCM_TOKEN')->pluck('FCM_TOKEN');
        
            $notification = [
                'title' =>$request->heading,
                'body' => $request->message,
                'icon' =>$request->url
            ];
            $extraNotificationData = ["message" => $notification];
    
            $fcmNotification = [
                'registration_ids' => $token, //multple token array
                // 'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];
            
            $res = $this->firebaseNotification($fcmNotification);

            if ($res) {
                return redirect()->back()->withSuccess('Sent Successfully !');
            }else{
                Log::info($res);
                return view('pushNotification');
            }
        }else{
            return view('pushNotification');
        }

    }
}
