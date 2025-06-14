@extends('layouts.app') {{-- On hérite du layout app.blade.php --}}

@section('title', 'Articles')

@section('content')
<div class="w-full flex flex-col gap-4 pb-8 " >
    

    @foreach($articles as $article)
        <div class="!p-4 flex flex-col gap-4 bg-white rounded-2xl overflow-hidden w-full">
            <img src="{{ asset('storage/' . $article->img) }}"  alt="{{ $article['title'] }}" class="bg-black w-full object-cover max-h-[300px] rounded-xl ">

            <div class="flex flex-col gap-4">
                <h4 class="font-bold text-xl">{{ $article['title'] }}</h4>

                <p>{{ $article['description'] }}</p>

                <p class="text-sm text-gray-500 text-end">
                    {{ \Carbon\Carbon::parse($article['created_at'])->format('d/m/Y') }}
                </p>
            </div>

            <div class="h-px w-full bg-gray-500"></div>

            <div class="flex justify-between items-center">
                <a href="{{ url('/articles/article/' . $article['id']) }}" class="px-3 py-1 hover:bg-gray-200 active:bg-gray-200 rounded-xl cursor-pointer">
                    Comment 💬
                </a>

                <div class="flex gap-1 justify-end">
                    <button class="px-3 py-1 hover:bg-gray-200 active:bg-gray-200 rounded-xl cursor-pointer">
                        Like 👍 {{ $article['totalLikes'] }}
                    </button>
                    <button class="px-3 py-1 hover:bg-gray-200 active:bg-gray-200 rounded-xl cursor-pointer">
                        Unlike 👎 {{ $article['totalUnlikes'] }}
                    </button>
                </div>
            </div>
        </div>
    @endforeach

</div>

<a href="/articles/new" class="fixed bottom-6 left-1/2 -translate-x-1/2 cursor-pointer bg-green-500 px-4 py-3 rounded-full font-bold text-white text-lg " >Publish article</a>

@endsection


