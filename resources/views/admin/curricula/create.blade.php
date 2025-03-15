@extends('layouts.admin')

@section('title', 'Создание плана')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Создать новый курс</h2>

    <form action="" method="POST">
        @csrf
        <!-- Основные поля -->
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Название курса</label>
                <input name="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Длительность (Часы)</label>
                    <input name="duration" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Выберите основной курс</label>
                    <select name="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">--- Выберите курс ---</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Дополнительные поля -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Темы (через запятую)</label>
                <input name="themes" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
        </div>

        <!-- Кнопки -->
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.curricula.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">Отмена</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Сохранить курс</button>
        </div>
    </form>
</div>
@endsection
