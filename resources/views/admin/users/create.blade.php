@extends('layouts.admin')

@section('title', 'Ручная регистрация пользователя')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">
        <form action="{{ route('admin.users.create') }}" method="POST">
            @csrf

            {{-- Поле имени --}}

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Имя</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                    placeholder="Введите имя пользователя">
            </div>

            <!-- Поле email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                    placeholder="Введите email пользователя">
            </div>

            <!-- Поле пароля -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Пароль</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                    placeholder="Введите пароль">
            </div>

            <!-- Кнопка входа -->
            <button
                type="submit"
                class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                Зарегистрировать
            </button>
        </form>
    </div>
</div>
@endsection
