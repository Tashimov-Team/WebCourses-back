<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Навбар -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <span class="text-xl font-bold text-gray-800">Админ-панель ₍^. .^₎⟆</span>
                    <div class="hidden md:flex space-x-4">
                        <a href="/admin/courses" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Курсы</a>
                        <a href="/admin/curricula" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Учебные планы</a>
                        <a href="/admin/users" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Пользователи</a>
                        <a href="/admin/videos" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Видео</a>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Выйти</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Контент -->
    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>
</body>
</html>
