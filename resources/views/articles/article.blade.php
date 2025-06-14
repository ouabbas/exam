

@extends('layouts.app') {{-- On hérite du layout app.blade.php --}}

@section('header')
<div class="flex w-full justify-start ">
    <button onclick="history.back()" class="cursor-pointer py-2 rounded font-bold text-white ">
    ← Retour
    </button>
</div>
@endsection

@section('title', $article['title'])

@section('content')
@php
    use Carbon\Carbon;
    $articleCreated = Carbon::parse($article['created_at']);
@endphp


<div class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden w-full " >
    <div class="!p-4 flex flex-col gap-4 ">
        <img src="{{ asset('storage/' . $article->img) }}"  alt="dzayer" class="bg-black w-full object-cover max-h-[300px] rounded-xl" >
        
        <div class="flex flex-col gap-4">

            <p>{{ $article['description'] }}</p>

            <p class="text-sm text-gray-500 text-end " >
                @if ($articleCreated->isToday())
                    {{ 'Today at ' . $articleCreated->format('H:i') }}
                @elseif ($articleCreated->isYesterday())
                    {{ 'Yesterday at ' . $articleCreated->format('H:i') }}
                @else
                    {{ $articleCreated->format('d/m/Y \à H:i') }}
                @endif
            </p>
        </div>

        <div class="h-px w-full bg-gray-300 " ></div>

        <form method="POST" action="{{ route($hasLiked ? 'articles.article.dislike' : 'articles.article.like', $article->id) }}"  class="flex items-center gap-1 justify-between ">
            <p>@csrf{{ $likesCount }} likes</p>
            <button class=" px-3 py-1 hover:bg-gray-200 active:bg-gray-200 rounded-xl cursor-pointer {{ $hasLiked ? 'bg-green-100' :'' }} ">{{ $hasLiked ? "Dislike 👎" : "Like 👍"}}</button>
        </form>

        <form method="POST" action="{{ route('articles.article.comment', $article->id) }}" class="flex gap-2">
            @csrf
            <input 
                type="text" 
                name="comment" 
                placeholder="Your comment here" 
                class="flex-1 bg-gray-100 py-2 px-2 rounded-md focus:outline-0" 
                required
            >
            <button 
                type="submit" 
                class="cursor-pointer bg-green-500 text-white px-4 rounded-md hover:bg-green-600 transition"
            >
                Submit
            </button>
        </form>


        <div class="flex flex-col gap-2 ">
        @foreach($comments as $comment)
            @php
                $commentCreated = Carbon::parse($comment->created_at);
            @endphp
            <div class="flex flex-col gap-2 py-2 px-2 rounded-md bg-gray-100">
                <p class="text-sm font-bold">
                    @if ($commentCreated->isToday())
                        {{ 'Today at ' . $commentCreated->format('H:i') }}
                    @elseif ($commentCreated->isYesterday())
                        {{ 'Yesterday at ' . $commentCreated->format('H:i') }}
                    @else
                        {{ $commentCreated->format('d/m/Y \à H:i') }}
                    @endif
                </p>
                <p class="text-sm">
                    {{ $comment->comment }}
                </p>
            </div>
        @endforeach

        </div>
    </div>
</div>
@endsection


