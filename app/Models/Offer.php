<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Offer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "offer";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OFFER_TYPE','OFFER_DISPLAY_TYPE','OFFER_CATEGORY', 'OFFER_NAME', 'OFFER_DETAILS', 'OFFER_STEPS','OFFER_AMOUNT','OFFER_PACKAGE','OFFER_THUMBNAIL', 'OFFER_BANNER', 'OFFER_URL', 'OFFER_OS','OFFER_ORIGIN','CAP','FALLBACK_URL','STARTS_FROM','ENDS_ON','STATUS','OFFER_APP','CREATED_BY','OFFER_INSTRUCTIONS'
    ];

  

  
}
