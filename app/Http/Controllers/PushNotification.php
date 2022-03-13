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
            $fcmUrl = config('firebase.fcm_url');

            $apiKey = config('firebase.fcm_api_key');

            $token= DB::table('users')->whereNotNull('FCM_TOKEN')->pluck('FCM_TOKEN')->all();
    
            $data = [
                "registration_ids" => $token,
                "notification" => [
                    "title" => $request->heading,
                    "body" => $request->message,  
                ]
            ];
    
            $RESPONSE = json_encode($data);
        
            $headers = [
                'Authorization:key=' . $apiKey,
                'Content-Type: application/json',
            ];
        
            // CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $RESPONSE);
    
            $output = curl_exec($ch);
            // if ($output === FALSE) {
            //     die('Curl error: ' . curl_error($ch));
            // }        
            curl_close($ch);
            $res = json_decode($output);
           
            if ($res->success) {
                return redirect()->back()->withSuccess('Sent Successfully !');
            }else{
                Log::info($output);
                return view('pushNotification');
            }
        }else{
            return view('pushNotification');
        }

    }
}
