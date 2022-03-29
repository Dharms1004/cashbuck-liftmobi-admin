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
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


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
                'send_to' => 'required',
                'user_list' => 'required_if:send_to,2',
            ]);
            
            if ($validator->fails()) {
                return redirect('sendNotification')
                    ->withErrors($validator)
                    ->withInput();
            }

            $res = $this->sendToFCM($request);

        
            if ($res) {
                // return redirect()->back()->withSuccess($res['success']." sent ".$res['failure']."failed out of ".$res['success']+$res['failure'] );
                return redirect()->back()->withSuccess("Sent Successfully.");

            }else{
                return view('pushNotification');
            }
        }else{
            // $this->sendToFCM();
            return view('pushNotification');
        }

    }

    private function sendToFCM($request){

        if($request->send_to == 2){
            $emailIds = explode('||', $request->user_list);

            $token = DB::table('users')->whereNotNull('FCM_TOKEN')->whereIn('SOCIAL_EMAIL', $emailIds)->pluck('FCM_TOKEN')->all();
            
        }else{
            
            $token = DB::table('users')->whereNotNull('FCM_TOKEN')->pluck('FCM_TOKEN')->all();
        }

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($request->heading);
        $notificationBuilder->setBody($request->message)->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['App' => 'Android']);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $filteredTokens = array_filter($token);
        // dd($filteredTokens);
        $downstreamResponse = FCM::sendTo($filteredTokens, $option, $notification, $data);

        $res['success'] = $downstreamResponse->numberSuccess();
        $res['failure'] = $downstreamResponse->numberFailure();
        $res['modificstion'] = $downstreamResponse->numberModification();

        return $res;
        
    }
}
