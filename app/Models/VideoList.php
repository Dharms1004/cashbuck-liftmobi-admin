<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoList extends Model
{
    use HasFactory;

    protected $table = "video_listing";
    public $timestamps = FALSE;

    protected $fillable = [
        'title','desc','banner','status','url','video_url'
    ];
}
