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

class Withdraw extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function withdrawList(Request $request)
    {

        $page = request()->page;
        $withdraw = DB::table('master_transaction_history')
            ->select('users.USER_ID', 'master_transaction_history.BALANCE_TYPE_ID', 'master_transaction_history.TRANSACTION_STATUS_ID', 'master_transaction_history.TRANSACTION_TYPE_ID', 'PAYOUT_COIN', 'PAYOUT_EMIAL', 'PAY_MODE', 'TRANSACTION_DATE', 'INTERNAL_REFERENCE_NO', 'PAYOUT_NUMBER', 'CURRENT_TOT_BALANCE', 'CLOSING_TOT_BALANCE', 'users.SOCIAL_NAME', 'transaction_status.TRANSACTION_STATUS_NAME', 'transaction_type.TRANSACTION_TYPE_NAME', 'balance_type.BALANCE_TYPE')
            ->join('users', 'users.USER_ID', '=', 'master_transaction_history.USER_ID')
            ->join('transaction_type', 'transaction_type.TRANSACTION_TYPE_ID', '=', 'master_transaction_history.TRANSACTION_TYPE_ID')
            ->join('transaction_status', 'transaction_status.TRANSACTION_STATUS_ID', '=', 'master_transaction_history.TRANSACTION_STATUS_ID')
            ->join('balance_type', 'balance_type.BALANCE_TYPE_ID', '=', 'master_transaction_history.BALANCE_TYPE_ID')
            ->whereIn('master_transaction_history.TRANSACTION_TYPE_ID',[6])
            ->whereIn('master_transaction_history.TRANSACTION_STATUS_ID',[6])
            ->orderBy('MASTER_TRANSACTTION_ID', 'desc');

        $withdrawata = $withdraw->paginate(1000, ['*'], 'page', $page);
        $params = $request->all();
        $params['page'] = $page;
        return view('withdraw', ['withdrawatas' => $withdrawata, 'params' => $params]);

    }
    public function witdrawApprove(Request $request)
    {
        $requestTableData = $request->tableData;
        foreach ($requestTableData as $tableData) {
            $refNoArray[] = $tableData['refNo'];
        }
        $withdrawDataRefNo = DB::table('master_transaction_history')->select('INTERNAL_REFERENCE_NO')
            ->whereIn('INTERNAL_REFERENCE_NO', $refNoArray)->where('TRANSACTION_STATUS_ID', 6)->get();
            foreach ($withdrawDataRefNo as $withdrawDataRefNo) {
                $pendingRefNoArray[] = $withdrawDataRefNo->INTERNAL_REFERENCE_NO;
            }
            $updateOffer = MasterTransactionHistory::whereIn('INTERNAL_REFERENCE_NO', $pendingRefNoArray)->update(['TRANSACTION_STATUS_ID' =>7]);
            return $updateOffer;
    }
}
