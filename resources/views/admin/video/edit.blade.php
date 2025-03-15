@extends('layouts.admin')

@section('title', 'Редактирование видео')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Отредактировать видео</h2>

    <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Основные поля -->
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Название видео</label>
                <input value="{{ $video->title }}" name="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Длительность (XX:XX)</label>
                    <input value="{{ $video->duration }}" name="duration" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Курс</label>
                    <select name="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">--- Выберите курс ---</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Загрузка видео -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Видео</label>
                <input name="video" type="file" class="ml-5 py-2 px-3 border border-gray-300 rounded-md text-sm" required>
            </div>
        </div>

        <!-- Кнопки -->
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.videos.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">Отмена</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Сохранить видео</button>
        </div>
    </form>
</div>
@endsection
