@extends('layouts.admin')

@section('title', 'Управление курсами')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Все курсы</h2>
        <a href="{{ route('admin.courses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Новый курс</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Цена</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Категория</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($courses as $course)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->id }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <span>{{ $course->title }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $course->price }}</td>
                    <td class="px-6 py-4">{{ $course->category }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.courses.update', $course) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редактировать</a>
                        <form action="{{ route('admin.courses.delete', $course) }}" method="POST">
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
