<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUser = DB::table('users')->count();
        $activeOffers = DB::table('offer')->where('STATUS', 1)->count();
        $newUsers = DB::table('users')->whereDate('CREATED_AT', Carbon::today())->count();
        $withrawRequest = DB::table('master_transaction_history')->where(['TRANSACTION_TYPE_ID' => 6, 'TRANSACTION_STATUS_ID' => 6])->count();
        $totalConvertedoffer = DB::table('offer_clicks')->count();
        $totalConvertedOfferToday = DB::table('offer_clicks')->whereDate('CLICKED_ON', Carbon::today())->count();
        $uniqueUsers = DB::table('offer_clicks')->distinct('USER_ID')->count();

        return view('home', compact('totalUser','activeOffers', 'newUsers', 'withrawRequest','totalConvertedoffer', 'totalConvertedOfferToday', 'uniqueUsers'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

}
