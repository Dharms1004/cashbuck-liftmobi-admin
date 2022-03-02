<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Promotions;
use App\Models\User;
use App\Models\Offer;
use App\Models\MasterTransactionHistory;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class UserList extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAllUser(Request $request)
    {
        //if ($request->isMethod('post')) {
        $page = request()->page;
        $user = DB::table('users as u')
            ->select('u.*')
            // ->join('user_wallet as uw', 'u.USER_ID', '=', 'uw.USER_ID')
            // ->join('balance_type as bt', 'bt.BALANCE_TYPE_ID', '=', 'uw.BALANCE_TYPE')
            ->orderBy('USER_ID', 'desc');
        // dd($promotion);
        $userData = $user->paginate(1000, ['*'], 'page', $page);
        $params = $request->all();
        $params['page'] = $page;
        return view('userList', ['userDatas' => $userData, 'params' => $params]);
        // } else {
        //     return view('offerList');
        // }
    }
    public function getUserDetails(Request $request)
    {
        $user = DB::table('users as u')
        ->select('u.*','uw.BALANCE','uw.BALANCE_TYPE','bt.BALANCE_TYPE as BALANCE_TYPE_DESC')
        ->where('u.USER_ID',$request->userId)
        ->join('user_wallet as uw', 'u.USER_ID', '=', 'uw.USER_ID')
        ->join('balance_type as bt', 'bt.BALANCE_TYPE_ID', '=', 'uw.BALANCE_TYPE')
        ->first();
        //return json_encode($user);
        return response()->json([
            'USER_ID' => $user->USER_ID ?? "",
            'SOCIAL_NAME' => $user->SOCIAL_NAME ?? "",
            'OCCUPATION' => $user->OCCUPATION ?? "",
            'PROFILE_PIC' => $user->PROFILE_PIC ?? "",
            'BALANCE' => $user->BALANCE ?? "",
            'BALANCE_TYPE' => $user->BALANCE_TYPE_DESC ?? "",
          ]);

    }
}
