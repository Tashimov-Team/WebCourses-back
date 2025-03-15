@extends('layouts.admin')

@section('title', 'Видеоматериалы')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Приятного просмотра</h2>
    </div>

    <div class="overflow-x-auto flex justify-center">
        @if (empty($url))
        <h1>Видео не существует</h1>
        @endif
        <video src="{{ $url }}" controls class="my-5"></video>
    </div>
    <div class="mt-6 flex justify-end space-x-3 mb-6 mr-6">
        <a href="" class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">Назад</a>
    </div>
</div>
@endsection
