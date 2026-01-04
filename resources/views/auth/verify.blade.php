<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение почтового адреса</title>

    @vite('resources/css/app.css')

</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
    <h1 class="text-2xl font-bold text-center mb-6">
        Регистрация
    </h1>

        <!-- Send verify notice -->
        <div>
            <h3 class="text-1xl font-bold text-center mb-6">
                Пожалуйста пройдите по ссылке из письма, которое мы отправили вам.
            </h3>
        </div>

        <!-- Buttons -->
        <div class="space-y-3">
            <a
                    href="{{ route('home') }}"
                    class="block text-center w-full border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition"
            >
                На главную
            </a>
        </div>
</div>

</body>
</html>