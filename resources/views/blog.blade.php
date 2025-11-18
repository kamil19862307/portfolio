<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite('resources/css/app.css')
      <style>
          :root{
              --primary: #0f172a; /* тёмный акцент (можешь заменить) */
              --accent: #2563eb;  /* синий акцент */
              --muted: #6b7280;
              --card: #ffffff;
              --bg: #f8fafc;
              --radius: 14px;
          }
          body { background: var(--bg); font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; color: var(--primary); }
          .accent { color: var(--accent); }
          .bg-accent { background-color: var(--accent); }
          .muted { color: var(--muted); }
      </style>
</head>
<body class="antialiased">

<!-- Header -->
<header class="bg-white/60 backdrop-blur sticky top-0 z-40 border-b border-gray-200">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-md bg-accent flex items-center justify-center text-white font-semibold">KM</div>
            <div>
                <div class="text-sm font-semibold">Камиль Музафаров</div>
                <div class="text-xs muted">Блог и заметки</div>
            </div>
        </a>
        <nav class="hidden sm:flex items-center gap-6 text-sm muted">
            <a href="/" class="hover:underline">Главная</a>
            <a href="/about" class="hover:underline">Обо мне</a>
            <a href="/services" class="hover:underline">Услуги</a>
            <a href="/portfolio" class="hover:underline">Портфолио</a>
            <a href="/contact" class="hover:underline">Контакты</a>
        </nav>
        <div class="hidden sm:flex items-center gap-3">
            <input type="search" placeholder="Поиск по блогу" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--accent)]" />
            <a href="/subscribe" class="px-3 py-2 rounded-lg bg-accent text-white text-sm">Подписаться</a>
        </div>
    </div>
</header>

<main class="max-w-5xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Левая колонка: профиль (как на твоём портфолио) -->
    <aside class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-[var(--radius)] p-6 shadow">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-sky-600 to-indigo-600 flex items-center justify-center text-white text-xl font-bold">KM</div>
                <div>
                    <div class="text-lg font-semibold">Привет, я Камиль</div>
                    <div class="text-sm muted">Frontend / UI Engineer</div>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-3 gap-3 text-center">
                <div>
                    <div class="text-lg font-bold">15</div>
                    <div class="text-xs muted">Проектов</div>
                </div>
                <div>
                    <div class="text-lg font-bold">25+</div>
                    <div class="text-xs muted">Клиентов</div>
                </div>
                <div>
                    <div class="text-lg font-bold">58+</div>
                    <div class="text-xs muted">Сообщений</div>
                </div>
            </div>

            <div class="mt-5 flex flex-col gap-2">
                <a href="/about" class="text-sm px-3 py-2 rounded-md border border-gray-200 text-center">Обо мне</a>
                <a href="/contact" class="text-sm px-3 py-2 rounded-md bg-accent text-white text-center">Написать</a>
            </div>
        </div>

        <div class="bg-white rounded-[var(--radius)] p-5 shadow">
            <h4 class="text-sm font-semibold">Категории</h4>
            <ul class="mt-3 space-y-2 text-sm muted">
                <li><a href="?cat=product" class="flex justify-between">Продукт <span class="text-xs">12</span></a></li>
                <li><a href="?cat=tech" class="flex justify-between">Технологии <span class="text-xs">8</span></a></li>
                <li><a href="?cat=design" class="flex justify-between">Дизайн <span class="text-xs">6</span></a></li>
            </ul>
        </div>

        <div class="bg-white rounded-[var(--radius)] p-5 shadow">
            <h4 class="text-sm font-semibold">Быстрая связь</h4>
            <form class="mt-3 space-y-3">
                <input type="text" placeholder="Имя" class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm" />
                <input type="email" placeholder="Email" class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm" />
                <textarea rows="3" placeholder="Сообщение" class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm"></textarea>
                <button class="w-full px-3 py-2 bg-accent text-white rounded-md text-sm">Отправить</button>
            </form>
        </div>
    </aside>

    <!-- Основной контент: список постов -->
    <section class="lg:col-span-3 space-y-6">
        <!-- Hero / Заголовок страницы -->
        <div class="bg-white rounded-[var(--radius)] p-6 shadow flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold">Новости и статьи</h1>
                <p class="mt-1 muted max-w-xl">Обновления, кейсы и заметки о разработке, дизайне и продуктах.</p>
            </div>
            <div class="hidden md:block">
                <div class="text-sm muted">Фильтр</div>
                <div class="mt-2 flex gap-2">
                    <button class="px-3 py-1 rounded-md border border-gray-200 text-sm">Все</button>
                    <button class="px-3 py-1 rounded-md border border-gray-200 text-sm">Технологии</button>
                    <button class="px-3 py-1 rounded-md border border-gray-200 text-sm">UI/UX</button>
                </div>
            </div>
        </div>

        <!-- Featured post -->
        <article class="bg-white rounded-[var(--radius)] overflow-hidden shadow hover:shadow-md transition">
            <div class="md:flex">
                <div class="md:w-1/3">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop" alt="featured" class="w-full h-48 object-cover" />
                </div>
                <div class="p-6 md:w-2/3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs bg-accent/10 text-accent px-2 py-1 rounded-full font-medium">Анонс</span>
                        <span class="text-xs muted">14 ноября 2025</span>
                    </div>
                    <h2 class="mt-3 text-xl font-bold">Запуск новой фичи: синхронизация календарей</h2>
                    <p class="mt-2 muted">Краткое описание релиза: как это работает и какие кейсы закрывает для пользователей.</p>
                    <div class="mt-4 flex items-center gap-4">
                        <a href="/blog/feature-sync" class="text-sm font-medium accent">Читать далее →</a>
                        <span class="text-sm muted">6 мин</span>
                    </div>
                </div>
            </div>
        </article>

        <!-- Сетка постов -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Card -->
            <article class="bg-white rounded-[var(--radius)] overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1508385082359-f2a3c1f3b6f1?q=80&w=1200&auto=format&fit=crop" alt="" class="w-full h-40 object-cover" />
                <div class="p-4">
                    <div class="text-xs muted">Кейс · 8 ноября 2025</div>
                    <h3 class="mt-2 font-semibold">Как мы ускорили отображение списка задач</h3>
                    <p class="mt-2 muted text-sm">Короткое превью с результатами и цифрами.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="/blog/post-1" class="text-sm accent font-medium">Открыть</a>
                        <span class="text-sm muted">7 мин</span>
                    </div>
                </div>
            </article>

            <article class="bg-white rounded-[var(--radius)] overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1496180727794-817822f65950?q=80&w=1200&auto=format&fit=crop" alt="" class="w-full h-40 object-cover" />
                <div class="p-4">
                    <div class="text-xs muted">Руководство · 2 октября 2025</div>
                    <h3 class="mt-2 font-semibold">Руководство по API интеграции</h3>
                    <p class="mt-2 muted text-sm">Простые шаги для быстрой интеграции с примерами.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="/blog/post-2" class="text-sm accent font-medium">Читать</a>
                        <span class="text-sm muted">10 мин</span>
                    </div>
                </div>
            </article>

            <article class="bg-white rounded-[var(--radius)] p-4 shadow hover:shadow-lg transition flex flex-col justify-between">
                <div>
                    <div class="text-xs muted">Обновление · 28 октября 2025</div>
                    <h3 class="mt-2 font-semibold">Мелкие улучшения интерфейса</h3>
                    <p class="mt-2 muted text-sm">Сборка правок, которые улучшают UX при работе с формами.</p>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="/blog/post-3" class="text-sm accent font-medium">Подробнее</a>
                    <span class="text-sm muted">3 мин</span>
                </div>
            </article>

            <article class="bg-white rounded-[var(--radius)] overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1522202222716-2c2b2d6a7b2b?q=80&w=1200&auto=format&fit=crop" alt="" class="w-full h-40 object-cover" />
                <div class="p-4">
                    <div class="text-xs muted">Инсайты · 3 ноября 2025</div>
                    <h3 class="mt-2 font-semibold">Кейс: миграция базы данных</h3>
                    <p class="mt-2 muted text-sm">Как мы подготовили бэкап и минимизировали даунтайм.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="/blog/post-4" class="text-sm accent font-medium">Читать</a>
                        <span class="text-sm muted">10 мин</span>
                    </div>
                </div>
            </article>
        </div>

        <!-- Пагинация -->
        <nav class="flex items-center justify-center gap-3">
            <button class="px-3 py-1 rounded-md border border-gray-200 muted">← Назад</button>
            <button class="px-3 py-1 rounded-md bg-accent text-white">1</button>
            <button class="px-3 py-1 rounded-md border border-gray-200 muted">2</button>
            <button class="px-3 py-1 rounded-md border border-gray-200 muted">Далее →</button>
        </nav>
    </section>
</main>

<!-- Footer -->
<footer class="border-t border-gray-200 bg-white/60">
    <div class="max-w-5xl mx-auto px-4 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm muted">© 2025 Камиль Музафаров</div>
        <div class="flex items-center gap-4 text-sm muted">
            <a href="/privacy" class="hover:underline">Политика</a>
            <a href="/terms" class="hover:underline">Условия</a>
        </div>
    </div>
</footer>

</body>
</html>