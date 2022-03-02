<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use App\Models\MasterTransactionHistory;
use App\Models\UserWallet;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class BalancePatch extends Controller
{


    public function index(){

        $promoBalanceTypeIds = [1, 2, 9, 4, 5, 7]; /** all promo earned balance */

        $mainBalanceTypeId = [8];  /** all offer conversion balance */

        $creditSuccessStatusId = 1;

        $lastUser = 0;

        $lastId = 738;

        UserWallet::where('ID', '>' , $lastId)->chunk(500, function($userWallet) use(&$lastUser,$promoBalanceTypeIds, $mainBalanceTypeId){

            foreach ($userWallet as $key => $user) {

                $userPromoBalance = MasterTransactionHistory::select(DB::raw('SUM(PAYOUT_COIN) AS PAYOUT_COIN'))->where(['USER_ID' => $user->USER_ID, 'TRANSACTION_STATUS_ID' => 1])->whereIn('TRANSACTION_TYPE_ID', $promoBalanceTypeIds)->groupBy('USER_ID')->first();
                $userMainBalance = MasterTransactionHistory::select(DB::raw('SUM(PAYOUT_COIN) AS PAYOUT_COIN'))->where(['USER_ID' => $user->USER_ID, 'TRANSACTION_STATUS_ID' => 1, 'TRANSACTION_TYPE_ID' => $mainBalanceTypeId])->groupBy('USER_ID')->first();

                UserWallet::where(['USER_ID' => $user->USER_ID])->update(['PROMO_BALANCE' => $userPromoBalance->PAYOUT_COIN ?? 0, "MAIN_BALANCE" => $userMainBalance->PAYOUT_COIN ?? 0]);

                $lastUser = $user['USER_ID'];
            }

        });
        echo "last user id is ".$lastUser;


    }

}
