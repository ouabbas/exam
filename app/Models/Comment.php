<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'article_id',
        'session_id',
    ];

    protected $table = 'comments';

    public $timestamps = true; // si tu n’utilises pas les champs created_at/updated_at
}
