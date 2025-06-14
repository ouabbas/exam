<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;

class ArticleController extends Controller
{
    public function index($id)
    {
        $article = Article::find($id);
        $comments = Comment::where('article_id', $id)
                   ->orderBy('created_at', 'desc')
                   ->get();
        $likesCount = Like::where('article_id', $id)->count();
        $sessionId = session()->getId();
        $hasLiked = Like::where('article_id', $id)
                        ->where('session_id', $sessionId)
                        ->exists();

        if (!$article) {
            abort(404, 'Article introuvable');
        }

        return view('articles.article', compact('article', 'comments', 'likesCount', 'hasLiked'));
    }

    public function comment(Request $request, $id)
    {
        try {
            // Validation
            $validated = $request->validate([
                'comment' => 'required|string',
            ]);

            $comment = Comment::create([
                'comment' => $request->input('comment'),
                'article_id' => $id,
                'session_id' => $request->session()->getId(),
            ]);

            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('[Article] Erreur lors de la création', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return back()->withErrors('Une erreur est survenue lors de la création de l\'article.');
        }
    }

    public function like(Request $request, $id)
    {
        $like = Like::firstOrCreate([
            'article_id' => $id,
            'session_id' => $request->session()->getId(),
        ]);

        return redirect()->back()->with('success', 'Liked !');
    }

    public function dislike(Request $request, $id)
    {
        Like::where('article_id', $id)
        ->where('session_id', $request->session()->getId())
        ->delete();

        return redirect()->back()->with('success', 'Unliked !');
    }
}
