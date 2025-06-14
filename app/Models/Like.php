<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'article_id',
        'session_id',
    ];

    protected $table = 'likes';

    public $timestamps = true;
}
