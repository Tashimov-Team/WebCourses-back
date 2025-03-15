@extends('layouts.admin')

@section('title', 'Учебные планы')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Учебные планы</h2>
        <a href="{{ route('admin.curricula.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Новый план</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Курс</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Темы</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Длительность</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($curriculum as $curricula)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $curricula->id }}</td>
                    <td class="px-6 py-4">Курс {{ $curricula->title }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-gray-100 rounded text-sm">{{ $curricula->themes }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $curricula->duration }} часов</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.curricula.update', $curricula) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редактировать</a>
                        <form action="{{ route('admin.curricula.delete', $curricula) }}" method="POST">
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
