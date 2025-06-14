

@extends('layouts.app') {{-- On hérite du layout app.blade.php --}}

@section('header')
<div class="flex w-full justify-start ">
    <button onclick="history.back()" class="cursor-pointer py-2 rounded font-bold text-white ">
    ← Retour
    </button>
</div>
@endsection

@section('title', "Publish a new articles")

@section('content')
<form 
    action="{{ route('articles.store') }}" 
    method="POST" 
    enctype="multipart/form-data" 
    class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden w-full p-4"
>
    @csrf
    <div class="flex flex-col gap-2 ">
        <p class="text-sm">Title <span class="text-red-600">*</span> </p>
        <input type="text" name="title" placeholder="Enter Title" class="flex-1 bg-gray-100 py-2 px-2 rounded-md focus:outline-0">
    </div>

    <div class="flex flex-col gap-2 ">
        <p class="text-sm">Description <span class="text-red-600">*</span> </p>
        <textarea name="description" placeholder="Enter Description" class="flex-1 bg-gray-100 py-2 px-2 rounded-md focus:outline-0"></textarea>
    </div>

    <div class="w-full max-w-md mx-auto">
        <label for="imageUpload" class="block text-sm font-medium text-gray-700 mb-2">Upload an image</label>
        <div
            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-gray-400 transition"
            onclick="document.getElementById('imageUpload').click()"
        >
            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-6 4l4-4m0 0l-4-4m4 4H3" />
            </svg>
            <p class="text-sm text-gray-500">Click to upload or drag an image here</p>
            <input id="imageUpload" name="image" type="file" accept="image/*" class="hidden" onchange="previewImage(event)">
        </div>

        <div id="imagePreview" class="mt-4 hidden">
            <p class="text-sm text-gray-600 mb-2">Preview:</p>
            <img src="" alt="Preview" class="w-full rounded-lg shadow border">
        </div>
    </div>

    <button type="submit" class="text-center bg-green-500 px-4 py-3 rounded-full font-bold text-white text-lg">Publish article</button>
</form>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = () => {
        const preview = document.getElementById('imagePreview');
        preview.classList.remove('hidden');
        preview.querySelector('img').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection


