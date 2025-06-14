<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        Log::info('Articles récupérés :', $articles->toArray());

        
        return view('home', compact('articles'));
    }
}
