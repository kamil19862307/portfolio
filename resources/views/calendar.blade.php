<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Запись на приём — Камиль Музафаров</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass { backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .day:hover { transform: translateY(-4px); transition: transform .12s ease; }
        .slot:hover { transform: scale(1.02); transition: transform .12s ease; }
        .unavailable { opacity: .35; cursor: not-allowed; }
        .calendar-grid { grid-template-columns: repeat(7, minmax(0,1fr)); }

        /* индикатор события — маленькая точка под числом */
        .day-has-event { position: relative; }
        .day-has-event::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 6px;
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #7c3aed;
            box-shadow: 0 0 0 4px rgba(124,58,237,0.08);
        }

        .day.selected { box-shadow: 0 6px 18px rgba(7, 17, 27, 0.06); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-indigo-50 text-gray-800 antialiased">
<header class="max-w-6xl mx-auto px-5 py-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-md bg-gradient-to-tr from-indigo-600 to-purple-500 flex items-center justify-center text-white font-semibold">KM</div>
            <div>
                <div class="font-semibold">Камиль Музафаров</div>
                <div class="text-xs text-gray-500">UI/UX Designer & Developer</div>
            </div>
        </div>
        <nav class="hidden md:flex items-center gap-6 text-sm text-gray-600">
            <a href="#" class="hover:text-indigo-600">Home</a>
            <a href="#" class="hover:text-indigo-600">Portfolio</a>
            <a href="#" class="hover:text-indigo-600">Services</a>
            <a href="#contact" class="px-3 py-2 bg-purple-600 text-white rounded-md">Contact</a>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-5 pb-20">
    <section class="bg-white rounded-2xl shadow-md border p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <h1 class="text-xl font-bold text-gray-800">ЗАПИСАТЬСЯ НА ПРИЁМ</h1>
            <p class="text-sm text-gray-600 mt-2">Выберите дату и удобное время</p>

            <!-- Controls -->
            <div class="mt-6 flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <button id="prevMonth" aria-label="Предыдущий месяц"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 ring-1 ring-gray-200">
                        <svg class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <button id="nextMonth" aria-label="Следующий месяц"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 ring-1 ring-gray-200">
                        <svg class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

                <div id="monthLabel" class="text-sm font-semibold text-gray-700 ml-2">Месяц Год</div>
                <div class="ml-auto text-xs text-gray-500">Часовой пояс: MSK</div>
            </div>

            <!-- Weekdays -->
            <div class="mt-4 grid calendar-grid text-center text-xs font-medium text-gray-500">
                <div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div>
            </div>

            <!-- Calendar -->
            <div id="calendar" class="mt-2 grid calendar-grid gap-2">
                <!-- Дни генерируются скриптом -->
            </div>

            <!-- Selected info -->
            <div class="mt-6 flex items-center gap-4">
                <div class="text-sm">
                    <div class="text-xs text-gray-500">Выбранная дата</div>
                    <div id="selectedDate" class="font-semibold text-gray-800">—</div>
                </div>
                <div class="text-sm">
                    <div class="text-xs text-gray-500">Выбранное время</div>
                    <div id="selectedTime" class="font-semibold text-gray-800">—</div>
                </div>
            </div>

            <!-- Time slots -->
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-800">Доступные промежутки времени</h3>
                <div id="slots" class="mt-3 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    <!-- Слоты генерируются скриптом -->
                </div>
            </div>
        </div>

        <aside class="bg-gradient-to-b from-white to-indigo-50 p-5 rounded-xl border glass">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-semibold">Подтвердить запись</h4>
                    <p class="text-sm text-gray-600 mt-1">Проверьте дату и время, добавьте комментарий, затем отправьте</p>
                </div>
                <div class="text-sm text-gray-500">Шаг 1 из 1</div>
            </div>

            <div class="mt-4 text-sm text-gray-700">
                <div><strong>Дата</strong>: <span id="confirmDate">—</span></div>
                <div class="mt-2"><strong>Время</strong>: <span id="confirmTime">—</span></div>
                <div class="mt-3 text-xs text-gray-500">Все времена указаны в Europe/Moscow</div>
            </div>

            <div class="mt-4">
                <label class="text-xs text-gray-600">Комментарий</label>
                <textarea id="comment" class="mt-2 block w-full rounded-md border-gray-200 shadow-sm p-2 text-sm" rows="3" placeholder="Например: Встреча по проекту"></textarea>
            </div>

            <!-- При необходимости замените user_id на динамическое значение -->
            <input type="hidden" id="userId" value="1" />

            <button id="confirmBtn" class="mt-6 w-full px-4 py-2 bg-purple-600 text-white rounded-md disabled:opacity-60" disabled>
                Подтвердить запись
            </button>

            <div class="mt-5 text-xs text-gray-500">
                Нужна помощь? Напишите на <strong>kamil@example.com</strong>
            </div>
        </aside>
    </section>
</main>

<script>
    // --- Настройки и элементы ---
    const serverTz = 'Europe/Moscow'; // APP_TIMEZONE
    const calendarEl = document.getElementById('calendar');
    const monthLabel = document.getElementById('monthLabel');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');
    const selectedDateEl = document.getElementById('selectedDate');
    const selectedTimeEl = document.getElementById('selectedTime');
    const slotsEl = document.getElementById('slots');
    const confirmBtn = document.getElementById('confirmBtn');
    const confirmDate = document.getElementById('confirmDate');
    const confirmTime = document.getElementById('confirmTime');
    const commentEl = document.getElementById('comment');
    const userIdEl = document.getElementById('userId');

    // Выделять день с существующей записью
    const SERVER_EVENTS = @json($events);

    // Делать не активным часы для занятой записи
    const SERVER_BUSY_RAW = @json($busyRaw);


    // --- Состояние ---
    const now = new Date();
    let viewDate = new Date(Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), 1));
    let chosenDate = null;        // Date object (UTC midnight of chosen day)
    let chosenTimeTs = null;      // epoch ms for chosen slot (UTC)

    // events set (YYYY-MM-DD UTC) — подсветка
    const events = new Set(SERVER_EVENTS || []);

    // busyRaw: пример данных от сервера; ожидается UTC ISO или epoch ms.
    const busyRaw = SERVER_BUSY_RAW || [];

    // const busyMs = new Set();
    // busyRaw.forEach(item => {
    //     if (typeof item === 'number') busyMs.add(Number(item));
    //     else {
    //         const p = Date.parse(item);
    //         if (!Number.isNaN(p)) busyMs.add(p);
    //     }
    // });

    const busyMs = new Set();
    busyRaw.forEach(item => {
        if (typeof item === 'number') {
            busyMs.add(Number(item));
            return;
        }
        const parsed = Date.parse(item);
        if (!Number.isNaN(parsed)) busyMs.add(parsed);
    });

    function startOfMonth(d) {
        return new Date(Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), 1));
    }

    function formatDateKeyUTC(date) {
        const y = date.getUTCFullYear();
        const m = String(date.getUTCMonth() + 1).padStart(2, '0');
        const d = String(date.getUTCDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    // --- Рендер календаря ---
    function renderCalendar() {
        calendarEl.innerHTML = '';
        const start = startOfMonth(viewDate);
        const year = start.getUTCFullYear();
        const month = start.getUTCMonth();
        monthLabel.textContent = start.toLocaleString('ru-RU', { month: 'long', year: 'numeric', timeZone: 'UTC' });

        const firstWeekday = (new Date(Date.UTC(year, month, 1)).getUTCDay() + 6) % 7;
        const daysInMonth = new Date(Date.UTC(year, month + 1, 0)).getUTCDate();

        for (let i = 0; i < firstWeekday; i++) {
            const empty = document.createElement('div');
            empty.className = 'p-3';
            calendarEl.appendChild(empty);
        }

        const highlightStart = new Date(Date.UTC(2024, 11, 30));
        const highlightEnd = new Date(Date.UTC(2025, 0, 3));
        const todayUTC = new Date();
        const todayNormalized = new Date(Date.UTC(todayUTC.getUTCFullYear(), todayUTC.getUTCMonth(), todayUTC.getUTCDate()));

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(Date.UTC(year, month, day));
            const key = formatDateKeyUTC(date);
            const cell = document.createElement('button');
            cell.className = 'day p-3 rounded-lg text-sm text-gray-700 text-center bg-white border';
            cell.textContent = day;

            if (date >= highlightStart && date <= highlightEnd) {
                cell.classList.add('bg-amber-50', 'border-amber-200', 'text-amber-700');
            } else {
                if (date < todayNormalized) {
                    cell.classList.add('unavailable');
                    cell.disabled = true;
                }
            }

            if (events.has(key)) {
                cell.classList.add('day-has-event');
                cell.title = 'Есть событие';
            }

            cell.addEventListener('click', () => {
                document.querySelectorAll('.day').forEach(d => d.classList.remove('ring-2','ring-amber-300','bg-amber-100','selected'));
                cell.classList.add('ring-2','ring-amber-300','bg-amber-100','selected');
                chosenDate = date;
                selectedDateEl.textContent = date.toLocaleDateString('ru-RU', { day: 'numeric', month: 'long', year: 'numeric', timeZone: 'UTC' });
                confirmDate.textContent = selectedDateEl.textContent;
                chosenTimeTs = null;
                selectedTimeEl.textContent = '—';
                confirmTime.textContent = '—';
                confirmBtn.disabled = true;
                renderSlotsForDate(date);
            });

            calendarEl.appendChild(cell);
        }
    }

    // --- Рендер слотов и выбор слота (храним epoch ms) ---
    function renderSlotsForDate(date) {
        slotsEl.innerHTML = '';

        // Слоты генерируем в UTC (источник истины) — 06:00 — 09:30 UTC по 30 минут
        const startHour = 6;
        const endHour = 14;
        const slots = [];
        for (let h = startHour; h <= endHour; h++) {
            slots.push({ h, m: 0 });
            if (!(h === endHour)) slots.push({ h, m: 30 });
            else slots.push({ h, m: 30 });
        }

        // Подпись для подсказки, покажем timezone
        const tzLabel = serverTz || 'Europe/Moscow';

        slots.forEach(({h,m}) => {
            const slotDate = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), h, m, 0));
            const slotTs = slotDate.getTime(); // epoch ms UTC

            const btn = document.createElement('button');
            btn.className = 'slot text-sm p-2 rounded-md border bg-white text-gray-700 flex flex-col items-center';
            // Показываем два ряда: сверху — локальное время сервера, снизу — мелким шрифтом UTC (если нужно)
            // Форматируем локальное время в serverTz
            const localForUi = new Date(slotTs).toLocaleString('ru-RU', {
                timeZone: tzLabel,
                hour: '2-digit', minute: '2-digit', hour12: false
            });

            const utcForUi = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')} UTC`;

            btn.innerHTML = `<span class="font-medium">${localForUi} (MSK)</span><span class="text-xs text-gray-400">${utcForUi}</span>`;

            if (busyMs.has(slotTs)) {
                btn.classList.add('unavailable');
                btn.disabled = true;
            }

            btn.addEventListener('click', () => {
                document.querySelectorAll('.slot').forEach(s => s.classList.remove('ring-2','ring-indigo-300','bg-indigo-50'));
                btn.classList.add('ring-2','ring-indigo-300','bg-indigo-50');

                // сохраняем однозначно — epoch ms UTC
                chosenTimeTs = slotTs;

                // отображаем выбранное время в UI как локальное серверное (MSK)
                selectedTimeEl.textContent = new Date(chosenTimeTs).toLocaleString('ru-RU', {
                    timeZone: tzLabel,
                    hour: '2-digit', minute: '2-digit', hour12: false
                }) + ' (MSK)';

                confirmTime.textContent = selectedTimeEl.textContent;
                confirmBtn.disabled = false;
            });

            slotsEl.appendChild(btn);
        });
    }

    // --- Навигация месяцев ---
    prevBtn.addEventListener('click', () => {
        viewDate = new Date(Date.UTC(viewDate.getUTCFullYear(), viewDate.getUTCMonth() - 1, 1));
        renderCalendar();
    });
    nextBtn.addEventListener('click', () => {
        viewDate = new Date(Date.UTC(viewDate.getUTCFullYear(), viewDate.getUTCMonth() + 1, 1));
        renderCalendar();
    });

    // --- Отправка данных на /calendar ---
    confirmBtn.addEventListener('click', async () => {
        if (!chosenDate || !chosenTimeTs) return;

        const userId = Number(userIdEl.value || 1);
        const comment = commentEl.value || '';

        // Формируем begin_at в Europe/Moscow как "YYYY-MM-DD HH:mm:ss"
        const dt = new Date(chosenTimeTs);
        // Надёжный способ: получить строку в формате sv-SE в нужной TZ и привести к формату
        let local = dt.toLocaleString('sv-SE', { timeZone: serverTz });
        local = local.replace('T', ' '); // если вернулся с T
        const begin_at = local.slice(0, 19); // "YYYY-MM-DD HH:mm:ss"

        const payload = { begin_at, user_id: userId, comment };

        // CSRF token
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = tokenMeta ? tokenMeta.getAttribute('content') : null;

        confirmBtn.disabled = true;
        const prevText = confirmBtn.textContent;
        confirmBtn.textContent = 'Отправка...';

        try {
            const res = await fetch('/api/calendar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify(payload),
                credentials: 'same-origin'
            });

            if (!res.ok) {
                let errText = `${res.status} ${res.statusText}`;
                try {
                    const json = await res.json();
                    if (json.message) errText = json.message;
                } catch (e) {}
                throw new Error(errText);
            }

            confirmBtn.textContent = 'Запись подтверждена';
            // Очистка UI
            selectedDateEl.textContent = '—';
            selectedTimeEl.textContent = '—';
            confirmDate.textContent = '—';
            confirmTime.textContent = '—';
            commentEl.value = '';
            chosenDate = null;
            chosenTimeTs = null;
        } catch (err) {
            console.error('Booking error:', err);
            alert('Не удалось отправить запись: ' + err.message);
        } finally {
            setTimeout(() => {
                confirmBtn.disabled = false;
                confirmBtn.textContent = prevText;
            }, 1200);
        }
    });

    // --- Init: рендерим календарь и пробуем выбрать сегодня ---
    renderCalendar();
    setTimeout(() => {
        const todayKey = String(now.getUTCDate());
        const dayButtons = Array.from(document.querySelectorAll('.day'));
        const todayBtn = dayButtons.find(b => b.textContent.trim() === todayKey && !b.disabled);
        if (todayBtn) todayBtn.click();
    }, 80);

    // --- Пример загрузки busy slots с сервера (раскомментируйте и адаптируйте) ---
    fetch('/api/busy-slots?month=' + (viewDate.getUTCFullYear()) + '-' + String(viewDate.getUTCMonth()+1).padStart(2,'0'))
      .then(r => r.json())
      .then(list => {
        // ожидается list = ['2025-10-29T09:00:00Z', ...] или epoch ms
        busyRaw.length = 0;
        list.forEach(it => busyRaw.push(it));
        busyMs.clear();
        busyRaw.forEach(item => {
          const parsed = (typeof item === 'number') ? item : Date.parse(item);
          if (!Number.isNaN(parsed)) busyMs.add(parsed);
        });
        renderCalendar();
      })
      .catch(console.error);

</script>
</body>
</html>
```