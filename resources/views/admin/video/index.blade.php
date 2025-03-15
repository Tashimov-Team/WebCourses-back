@extends('layouts.admin')

@section('title', 'Видеоматериалы')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Видео материалы</h2>
        <a href="{{ route('admin.videos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Добавить видео</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Курс</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Длительность</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ссылка</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($videos as $video)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $video->id }}</td>
                    <td class="px-6 py-4">{{ $video->course->title }}</td>
                    <td class="px-6 py-4">{{ $video->title }}</td>
                    <td class="px-6 py-4">{{ $video->duration }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.videos.show', $video) }}" class="text-indigo-600 hover:text-indigo-900">Смотреть</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.videos.update', $video) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редактировать</a>
                        <form action="{{ route('admin.videos.delete', $video) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
