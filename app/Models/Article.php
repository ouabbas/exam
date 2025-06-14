<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'img',
        'description',
        'session_id',
    ];

    protected $table = 'articles';

    public $timestamps = true; // si tu n’utilises pas les champs created_at/updated_at
}

