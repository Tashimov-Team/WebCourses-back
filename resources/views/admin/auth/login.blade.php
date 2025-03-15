<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админку</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">Добро пожаловать!</h2>
                <p class="text-gray-600 mb-8">Войдите в панель управления</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Поле email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                        placeholder="Введите ваш email">
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
                    Войти
                </button>

                <!-- Сообщения об ошибках -->
                @if($errors->any())
                    <div class="mt-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg">
                        Неверные учетные данные
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
