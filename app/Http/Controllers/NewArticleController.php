<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class NewArticleController extends Controller
{
    public function index()
    {
        Log::info('[Article] Accès à la page de création');
        return view('articles.new');
    }

    public function store(Request $request)
    {
        Log::info('[Article] Formulaire reçu', [
            'session_id' => $request->session()->getId(),
            'ip' => $request->ip(),
        ]);

        try {
            // Validation
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|image|max:2048', // 2MB max
            ]);
            Log::info('[Article] Validation réussie', $validated);

            // Encodage image
            
            $imagePath = $request->file('image')->store('images', 'public');

            // Création de l'article
            $article = Article::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'img' => $imagePath,
                'session_id' => $request->session()->getId(),
            ]);

            Log::info('[Article] Article créé avec succès', ['id' => $article->id]);

            return redirect('/')->with('success', 'Article created!');
        } catch (\Exception $e) {
            Log::error('[Article] Erreur lors de la création', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return back()->withErrors('Une erreur est survenue lors de la création de l\'article.');
        }
    }
}
