<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Admin Panel — Demo</title>

    @vite('resources/css/app.css')

    <!-- Tailwind CDN with config -->
    <script>
            tailwind = {
            config: {
                theme: {
                    extend: {
                        colors: {
                            primary: '#2563EB',
                            cyanAccent: '#06B6D4',
                            pinkAccent: '#EC4899',
                            yellowAccent: '#F59E0B',
                            purpleAccent: '#7C3AED',
                            neutralBg: '#F8FAFC',
                            textDark: '#0F172A'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* small helper for smooth transitions */
        .smooth { transition: all .2s ease; }
    </style>
</head>
<body class="bg-neutralBg text-textDark antialiased">

<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-72 bg-white border-r border-gray-200 p-6 hidden md:block">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-12 h-12 rounded-md bg-primary flex items-center justify-center text-white font-bold">KM</div>
            <div>
                <div class="text-lg font-semibold">Музафаров</div>
                <div class="text-sm text-gray-500">Frontend / UI‑UX</div>
            </div>
        </div>

        <nav class="space-y-1">
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium text-primary bg-primary/5" href="#">Dashboard</a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50" href="#">Проекты</a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50" href="#">Клиенты</a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50" href="#">Календарь</a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50" href="#">Блог</a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50" href="#">Настройки</a>
        </nav>

        <div class="mt-8">
            <div class="text-xs text-gray-500 uppercase mb-2">Quick Contact</div>
            <div class="text-sm">kamlesh@example.com</div>
            <a class="text-sm text-primary mt-1 inline-block" href="#">linkedin.com/example</a>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white border-b border-gray-200 p-4 md:p-6">
            <div class="flex items-center gap-3">
                <button id="btnToggle" class="md:hidden p-2 rounded-md bg-white border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-textDark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="hidden md:flex items-center gap-4">
                    <div class="text-xl font-semibold">Панель управления</div>
                    <div class="text-sm text-gray-500">Добро пожаловать</div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <input id="search" type="search" placeholder="Поиск..." class="px-3 py-2 rounded-md border border-gray-200 bg-white text-sm w-48 focus:outline-none focus:ring-2 focus:ring-primary" />
                </div>
                <button id="btnNew" class="px-4 py-2 bg-primary text-white rounded-md text-sm">Say Hello!</button>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-sm font-medium">KM</div>
            </div>
        </header>

        <main class="p-4 md:p-6 space-y-6">
            <!-- Intro / Stats -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-lg border border-gray-200">
                    <div class="flex items-start gap-6">
                        <div class="w-20 h-20 rounded-lg bg-primary flex items-center justify-center text-white text-2xl font-bold">KM</div>
                        <div>
                            <h1 class="text-2xl font-bold">Музафаров</h1>
                            <p class="text-gray-600 mt-2">Я создаю удобные и красивые интерфейсы и взаимодействия из-за продуманного кода. Специализируюсь на UI/UX и Frontend разработке в адаптивных веб-приложениях.</p>
                            <div class="mt-4 flex gap-4">
                                <div class="p-3 bg-cyanAccent/10 rounded-md">
                                    <div class="text-sm text-gray-500">Опыт</div>
                                    <div class="text-lg font-semibold">15+ лет</div>
                                </div>
                                <div class="p-3 bg-pinkAccent/10 rounded-md">
                                    <div class="text-sm text-gray-500">Проектов</div>
                                    <div class="text-lg font-semibold">250+</div>
                                </div>
                                <div class="p-3 bg-yellowAccent/10 rounded-md">
                                    <div class="text-sm text-gray-500">Клиентов</div>
                                    <div class="text-lg font-semibold">100+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick actions / stats -->
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Новые заявки</div>
                                <div class="text-2xl font-bold">8</div>
                            </div>
                            <div class="text-sm text-green-600 font-semibold">+12%</div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <div class="text-sm text-gray-500">Активные проекты</div>
                        <div class="text-2xl font-bold">6</div>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <div class="text-sm text-gray-500">Доход за месяц</div>
                        <div class="text-2xl font-bold">€4,200</div>
                    </div>
                </div>
            </section>

            <!-- What I do -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-lg border border-gray-200">
                    <div class="text-sm text-gray-500">User Experience</div>
                    <h3 class="font-semibold mt-2">Удобные и доступные интерфейсы</h3>
                    <p class="text-gray-600 mt-2 text-sm">Создание удобных, доступных и приятных интерфейсов с использованием лучших практик UX‑дизайна.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-gray-200">
                    <div class="text-sm text-gray-500">User Interface</div>
                    <h3 class="font-semibold mt-2">Визуально привлекательные интерфейсы</h3>
                    <p class="text-gray-600 mt-2 text-sm">Разработка визуально привлекательных и интуитивно понятных пользовательских интерфейсов.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-gray-200">
                    <div class="text-sm text-gray-500">Web Development</div>
                    <h3 class="font-semibold mt-2">Адаптивные веб‑приложения</h3>
                    <p class="text-gray-600 mt-2 text-sm">Создание адаптивных и производительных веб‑приложений с использованием современных технологий.</p>
                </div>
            </section>

            <!-- Projects grid -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Portfolio</h2>
                    <div class="text-sm text-gray-500">Недавние проекты</div>
                </div>

                <div id="projects" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- project card template -->
                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="h-40 bg-gradient-to-br from-primary to-cyanAccent"></div>
                        <div class="p-4">
                            <div class="text-sm text-gray-500">Visual Design</div>
                            <h3 class="font-semibold mt-1">Project One</h3>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="text-xs text-gray-500">Case Study</div>
                                <button class="text-xs text-primary">View</button>
                            </div>
                        </div>
                    </article>

                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="h-40 bg-gradient-to-br from-pinkAccent to-purpleAccent"></div>
                        <div class="p-4">
                            <div class="text-sm text-gray-500">Illustration</div>
                            <h3 class="font-semibold mt-1">Brand Mascot</h3>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="text-xs text-gray-500">Case Study</div>
                                <button class="text-xs text-primary">View</button>
                            </div>
                        </div>
                    </article>

                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="h-40 bg-gradient-to-br from-yellowAccent to-primary"></div>
                        <div class="p-4">
                            <div class="text-sm text-gray-500">Visual Series</div>
                            <h3 class="font-semibold mt-1">Series</h3>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="text-xs text-gray-500">Case Study</div>
                                <button class="text-xs text-primary">View</button>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Users table -->
            <section class="bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold">Клиенты</h3>
                    <div class="text-sm text-gray-500">Список клиентов</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-gray-500">
                        <tr>
                            <th class="py-2 pr-4">Имя</th>
                            <th class="py-2 pr-4">Email</th>
                            <th class="py-2 pr-4">Проекты</th>
                            <th class="py-2 pr-4">Статус</th>
                        </tr>
                        </thead>
                        <tbody id="usersList" class="divide-y">
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 pr-4">Anna Petrova</td>
                            <td class="py-3 pr-4">anna@example.com</td>
                            <td class="py-3 pr-4">3</td>
                            <td class="py-3 pr-4"><span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">Active</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 pr-4">Ivan S.</td>
                            <td class="py-3 pr-4">ivan@example.com</td>
                            <td class="py-3 pr-4">1</td>
                            <td class="py-3 pr-4"><span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">Pending</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 pr-4">Olga K.</td>
                            <td class="py-3 pr-4">olga@example.com</td>
                            <td class="py-3 pr-4">5</td>
                            <td class="py-3 pr-4"><span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">Paused</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</div>

<!-- Modal (hidden) -->
<div id="modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h4 class="font-semibold">Написать сообщение</h4>
        <p class="text-sm text-gray-600 mt-2">Быстрая форма связи</p>
        <form id="contactForm" class="mt-4 space-y-3">
            <input class="w-full px-3 py-2 border rounded-md" placeholder="Имя" required />
            <input class="w-full px-3 py-2 border rounded-md" placeholder="Email" type="email" required />
            <textarea class="w-full px-3 py-2 border rounded-md" placeholder="Сообщение" rows="4" required></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" id="closeModal" class="px-4 py-2 rounded-md border">Отмена</button>
                <button type="submit" class="px-4 py-2 rounded-md bg-primary text-white">Отправить</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Sidebar toggle for mobile
    const btnToggle = document.getElementById('btnToggle');
    const sidebar = document.getElementById('sidebar');
    btnToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });

    // Modal open/close
    const btnNew = document.getElementById('btnNew');
    const modal = document.getElementById('modal');
    const closeModal = document.getElementById('closeModal');
    btnNew.addEventListener('click', () => modal.classList.remove('hidden'));
    closeModal.addEventListener('click', () => modal.classList.add('hidden'));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });

    // Simple search filter for users and projects
    const search = document.getElementById('search');
    const usersList = document.getElementById('usersList');
    const projects = document.getElementById('projects');

    search.addEventListener('input', (e) => {
        const q = e.target.value.toLowerCase().trim();
        // filter users
        Array.from(usersList.querySelectorAll('tr')).forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
        // filter projects by title/category
        Array.from(projects.querySelectorAll('article')).forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Contact form submit (demo)
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Сообщение отправлено (демо).');
        modal.classList.add('hidden');
        contactForm.reset();
    });
</script>
</body>
</html>