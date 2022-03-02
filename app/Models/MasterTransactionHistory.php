<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MasterTransactionHistory extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "master_transaction_history";
    public $timestamps = FALSE;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USER_ID','BALANCE_TYPE_ID','TRANSACTION_STATUS_ID', 'TRANSACTION_TYPE_ID', 'PAYOUT_COIN', 'PAYOUT_EMIAL','PAY_MODE','TRANSACTION_DATE','INTERNAL_REFERENCE_NO', 'PAYOUT_NUMBER', 'CURRENT_TOT_BALANCE', 'CLOSING_TOT_BALANCE'
    ];

  

  
}
