<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    use HasFactory;

    protected $table = "Headings";
    public $timestamps = FALSE;

    protected $fillable = [
        'HEADING','MESSAGE','THUMBNAIL','ACTION_URL', 'STATUS', 'IS_BUTTON', 'CREATED_ON'
    ];
}
