<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $table = "user_wallet";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const UPDATED_AT = 'UPDATE_DATE';
    const CREATED_AT = 'CREATED_DATE';
    protected $primaryKey = 'ID';
    protected $fillable = ['BALANCE_TYPE','PROMO_BALANCE','MAIN_BALANCE','BALANCE','USER_ID','CREATED_DATE','UPDATE_DATE'];

}
