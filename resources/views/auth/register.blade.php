<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация пользователя</title>

    @vite('resources/css/app.css')

</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
    <h1 class="text-2xl font-bold text-center mb-6">
        Регистрация пользователя
    </h1>

    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">

        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Имя
            </label>
            @error('name')
                <label for="name" class="block text-sm font-medium text-red-400 mb-1">
                    {{ $message }}
                </label>
            @enderror
            <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Введите имя"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 outline-none"
                    required
            >
        </div>

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

        <!-- Password confirmation -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Подтверждение пароля
            </label>
            <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="••••••••"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 outline-none"
                    required
            >
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-sm">

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
                Зарегистрироваться
            </button>

            <a
                    href="{{ route('login') }}"
                    class="block text-center w-full border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition"
            >
                Есть аккаунт
            </a>
        </div>
    </form>
</div>

</body>
</html>