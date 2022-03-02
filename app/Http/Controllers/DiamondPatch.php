<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use App\Models\MasterTransactionHistory;
use App\Models\User;
use App\Models\UserWallet;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class DiamondPatch extends Controller
{


    public function index(){

        $lastUser = 0;

        $maxId = DB::table('users')->select('USER_ID')->orderBy('USER_ID', 'DESC')->limit(1)->first();
        
        $lastId = 0;

        DB::table('users')->where('USER_ID', '>' , $lastId)->orderBy('USER_ID', 'ASC')->chunk(500, function($users) use(&$lastUser, $maxId){
                        
            foreach ($users as $key => $user) {

                UserWallet::insert([
                    'COIN_TYPE' => 2,
                    'BALANCE_TYPE' => 2,
                    'PROMO_BALANCE' => 0,
                    'MAIN_BALANCE' => 0,
                    'BALANCE' => 0,
                    'USER_ID' => $user->USER_ID,
                    'CREATED_DATE' => date('Y-m-d H:i:s')
                ]);

                $lastUser = $user->USER_ID;
            }

        });
        echo "last user id is ".$lastUser;


    }

}
