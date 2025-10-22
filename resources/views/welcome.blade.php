<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Камиль Музафаров — UI/UX Designer & Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Небольшие визуальные правки для статистики и карт портфолио */
        .stat-card { background: linear-gradient(90deg, rgba(99,102,241,0.08), rgba(139,92,246,0.02)); }
        .glass { backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .portfolio-item:hover .overlay { transform: translateY(0%); opacity: 1; }
        .overlay { transition: all .28s ease; transform: translateY(8%); opacity: 0; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-indigo-50 text-gray-800 antialiased">

<!-- NAV -->
<header class="sticky top-0 z-40 bg-white/70 glass backdrop-blur-md border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">
        <a class="flex items-center gap-3" href="#">
            <div class="w-10 h-10 rounded-md bg-gradient-to-tr from-indigo-600 to-purple-500 flex items-center justify-center text-white font-semibold">KM</div>
            <div>
                <div class="font-semibold">Камиль Музафаров</div>
                <div class="text-xs text-gray-500 -mt-0.5">UI/UX Designer & Developer</div>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
            <a href="#" class="text-indigo-600">Home</a>
            <a href="#about" class="hover:text-indigo-600">About</a>
            <a href="#process" class="hover:text-indigo-600">Process</a>
            <a href="#portfolio" class="hover:text-indigo-600">Portfolio</a>
            <a href="#blog" class="hover:text-indigo-600">Blog</a>
            <a href="{{ route('calendar') }}" class="hover:text-indigo-600">Calendar</a>
            <a href="#services" class="hover:text-indigo-600">Services</a>
            <a href="#contact" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm">Contact</a>
        </nav>

        <div class="md:hidden">
            <button aria-label="menu" class="p-2 rounded-md bg-white border">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- HERO -->
<main class="max-w-6xl mx-auto px-5 py-12">
    <section class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
        <div class="md:col-span-7">
            <p class="text-sm text-indigo-600 font-semibold mb-3">Hello</p>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">
                Привет, я Камиль Музафаров
            </h1>
            <p class="mt-4 text-gray-600 max-w-xl">
                Я создаю удобные и красивые интерфейсы и разворачиваю их в производительный код.
                Специализируюсь на UI/UX и frontend-разработке в адаптивных веб-приложениях.
            </p>

            <div class="mt-6 flex items-center gap-4">
                <a href="#contact" class="inline-flex items-center gap-2 px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md shadow">
                    Say Hello!
                </a>
                <a href="#portfolio" class="text-sm text-gray-600 hover:text-gray-800">View portfolio →</a>
            </div>

            <div class="mt-8 grid grid-cols-3 gap-4">
                <div class="stat-card p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">15</div>
                    <div class="text-xs text-gray-500 mt-1">Y. Experience</div>
                </div>
                <div class="stat-card p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">250+</div>
                    <div class="text-xs text-gray-500 mt-1">Projects Completed</div>
                </div>
                <div class="stat-card p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">58</div>
                    <div class="text-xs text-gray-500 mt-1">Happy Clients</div>
                </div>
            </div>
        </div>

        <div class="md:col-span-5 flex justify-center md:justify-end">
            <!-- Inline SVG avatar as placeholder. Replace with actual photo block when ready. -->
            <div class="w-56 h-56 rounded-xl shadow-lg overflow-hidden bg-white border">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <defs>
                        <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                            <stop offset="0" stop-color="#7c3aed"/>
                            <stop offset="1" stop-color="#06b6d4"/>
                        </linearGradient>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#g1)"/>
                    <g transform="translate(0,12)">
                        <rect x="14" y="26" width="172" height="148" rx="12" fill="#fff" opacity="0.08"/>
                        <text x="100" y="110" font-size="48" fill="white" font-family="sans-serif" font-weight="700" text-anchor="middle">KM</text>
                    </g>
                </svg>
            </div>
        </div>
    </section>

    <!-- ABOUT / SERVICES -->
    <section id="services" class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 bg-white p-8 rounded-xl shadow-sm border">
            <h2 class="text-2xl font-semibold">What I do?</h2>
            <p class="mt-3 text-gray-600 max-w-2xl">
                Я проектирую пользовательские пути, создаю визуально привлекательный интерфейс и реализую
                масштабируемые веб-приложения с акцентом на производительность и удобство.
            </p>
            <a href="#contact" class="mt-6 inline-block px-5 py-2 bg-indigo-600 text-white rounded-md">Say Hello!</a>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">User Experience</h4>
                    <p class="text-sm text-gray-500 mt-1">Исследование, вайрфреймы и прототипы, фокус на удобстве.</p>
                </div>
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">User Interface</h4>
                    <p class="text-sm text-gray-500 mt-1">Типографика, сетки, визуальные системы и дизайн-системы.</p>
                </div>
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">Web Development</h4>
                    <p class="text-sm text-gray-500 mt-1">Современный frontend, адаптивность, оптимизация и поддерживаемость.</p>
                </div>
            </div>
        </div>

        <aside class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-xl border glass">
            <h3 class="font-semibold text-lg">Quick contact</h3>
            <p class="text-sm text-gray-600 mt-2">Готов обсудить проект, сотрудничество или консультацию.</p>
            <div class="mt-4">
                <a href="#contact" class="block w-full text-center px-4 py-2 bg-purple-600 text-white rounded-md">Say Hello!</a>
            </div>
            <div class="mt-6 text-sm text-gray-500">
                <div><strong>Email</strong> — kamil@example.com</div>
                <div class="mt-2"><strong>Location</strong> — Варшава, Польша</div>
            </div>
        </aside>
    </section>

    <!-- PORTFOLIO -->
    <section id="portfolio" class="mt-14">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-semibold">Portfolio</h3>
                <p class="text-gray-600 mt-1">Недавние работы по проектированию интерфейсов и frontend-реализации.</p>
            </div>
            <a href="#portfolio" class="text-indigo-600 hidden sm:inline">View all</a>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Portfolio item template -->
            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-tr from-indigo-500 to-pink-400 flex items-center justify-center text-white font-bold">Project Image</div>
                    <div class="absolute inset-0 flex items-end">
                        <div class="w-full p-4 overlay">
                            <div class="bg-white/90 rounded-md p-3 flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-semibold">Product Admin Dashboard</div>
                                    <div class="text-xs text-gray-500">Responsive admin UI with data visualization</div>
                                </div>
                                <a href="#" class="text-indigo-600 text-sm">Case Study</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-tr from-green-400 to-emerald-500 flex items-center justify-center text-white font-bold">Project Image</div>
                    <div class="absolute inset-0 flex items-end">
                        <div class="w-full p-4 overlay">
                            <div class="bg-white/90 rounded-md p-3 flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-semibold">E-commerce Dashboard</div>
                                    <div class="text-xs text-gray-500">Analytics and management tools</div>
                                </div>
                                <a href="#" class="text-indigo-600 text-sm">Case Study</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold">Project Image</div>
                    <div class="absolute inset-0 flex items-end">
                        <div class="w-full p-4 overlay">
                            <div class="bg-white/90 rounded-md p-3 flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-semibold">SaaS Admin Panel</div>
                                    <div class="text-xs text-gray-500">Clean, component-driven UI</div>
                                </div>
                                <a href="#" class="text-indigo-600 text-sm">Case Study</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Additional visual items -->
            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="h-48 bg-cover bg-center" style="background-image:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(0,0,0,0.04)), url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22160%22></svg>')"></div>
                <div class="p-4">
                    <div class="text-sm font-semibold">Interior / Visual</div>
                    <div class="text-xs text-gray-500 mt-1">Lifestyle and product photography presentation</div>
                    <div class="mt-3"><a href="#" class="text-indigo-600 text-sm">Case Study</a></div>
                </div>
            </article>

            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="h-48 bg-green-50 flex items-center justify-center text-green-700 font-semibold">Illustration</div>
                <div class="p-4">
                    <div class="text-sm font-semibold">Brand Mascot</div>
                    <div class="text-xs text-gray-500 mt-1">Character design and assets</div>
                    <div class="mt-3"><a href="#" class="text-indigo-600 text-sm">Case Study</a></div>
                </div>
            </article>

            <article class="portfolio-item bg-white rounded-xl shadow overflow-hidden border">
                <div class="h-48 bg-purple-50 flex items-center justify-center text-purple-700 font-semibold">Photo</div>
                <div class="p-4">
                    <div class="text-sm font-semibold">Visual Series</div>
                    <div class="text-xs text-gray-500 mt-1">Editorial and photography composites</div>
                    <div class="mt-3"><a href="#" class="text-indigo-600 text-sm">Case Study</a></div>
                </div>
            </article>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="mt-14 mb-20 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-xl shadow-sm border">
            <h3 class="text-2xl font-semibold">Let's work together</h3>
            <p class="text-gray-600 mt-2">Расскажите о проекте, бюджете и сроках.</p>
            <form class="mt-6 space-y-4">
                <div>
                    <label class="text-sm text-gray-700">Name</label>
                    <input class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" placeholder="Камиль Музафаров" />
                </div>
                <div>
                    <label class="text-sm text-gray-700">Email</label>
                    <input class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" placeholder="kamil@example.com" />
                </div>
                <div>
                    <label class="text-sm text-gray-700">Message</label>
                    <textarea class="mt-1 block w-full rounded-md border-gray-200 shadow-sm h-28" placeholder="Кратко опишите задачу"></textarea>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Send message</button>
                </div>
            </form>
        </div>

        <div class="bg-gradient-to-b from-indigo-50 to-white p-8 rounded-xl border flex flex-col justify-center">
            <h4 class="font-semibold">Availability</h4>
            <p class="text-gray-600 mt-2">Открыт для фриланс проектов и сотрудничества.</p>
            <div class="mt-6">
                <div class="text-sm text-gray-500"><strong>Location</strong> — Варшава, Польша</div>
                <div class="text-sm text-gray-500 mt-2"><strong>Phone</strong> — +48 • ••• ••• •••</div>
                <div class="text-sm text-gray-500 mt-2"><strong>Email</strong> — kamil@example.com</div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t pt-6 pb-12 mt-10">
        <div class="max-w-6xl mx-auto px-5 text-center text-sm text-gray-500">
            © <span id="year"></span> Камиль Музафаров — Designed and built by me.
        </div>
    </footer>
</main>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>