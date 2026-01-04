<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    @vite('resources/css/app.css')

</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
    <h1 class="text-2xl font-bold text-center mb-6">
        Вход в аккаунт
    </h1>

    <form action="{{ route('login.store') }}" method="POST" class="space-y-5">

        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            @error('email')
                <label for="email" class="block text-sm font-medium text-red-400 mb-1">
                    {{ $message }}
                </label>
            @enderror
            <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="example@mail.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 outline-none"
                    required
            >
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Пароль
            </label>
            <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 outline-none"
                    required
            >
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                Запомнить меня
            </label>

            @error('remember')
            <label for="remember" class="block text-sm font-medium text-red-400 mb-1">
                {{ $message }}
            </label>
            @enderror

            <a href="#" class="text-blue-600 hover:underline">
                Забыли пароль?
            </a>
        </div>

        <!-- Buttons -->
        <div class="space-y-3">
            <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Войти
            </button>

            <a
                    href="{{ route('register.store') }}"
                    class="block text-center w-full border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition"
            >
                Регистрация
            </a>
        </div>
    </form>
</div>

</body>
</html>