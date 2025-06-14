<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewArticleController;
use App\Http\Controllers\ArticleController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/new', [NewArticleController::class, 'index'])->name('articles.new');
Route::post('/articles/store', [NewArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/article/{id}', [ArticleController::class, 'index'])->name('articles.article');
Route::post('/articles/article/{id}/comment', [ArticleController::class, 'comment'])->name('articles.article.comment');
Route::post('/articles/article/{id}/like', [ArticleController::class, 'like'])->name('articles.article.like');
Route::post('/articles/article/{id}/dislike', [ArticleController::class, 'dislike'])->name('articles.article.dislike');
