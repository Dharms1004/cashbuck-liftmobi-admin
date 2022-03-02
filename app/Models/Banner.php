<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = "mini_banner";
    public $timestamps = FALSE;

    protected $fillable = [
        'HEADING','THUMBNAIL','ACTION_URL', 'STATUS', 'CREATED_ON'
    ];
}
