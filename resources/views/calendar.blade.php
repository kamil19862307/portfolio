<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Запись на приём — Камиль Музафаров</title>
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

    /* визуальная правка для выделенной даты */
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
        <p class="text-sm text-gray-600 mt-2">Выберите дату и удобное время в UTC</p>

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
          <div class="ml-auto text-xs text-gray-500">Часовой пояс: UTC</div>
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
          <h3 class="text-sm font-semibold text-gray-800">Доступные промежутки времени UTC</h3>
          <div id="slots" class="mt-3 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
            <!-- Слоты генерируются скриптом -->
          </div>
        </div>
      </div>

      <aside class="bg-gradient-to-b from-white to-indigo-50 p-5 rounded-xl border glass">
        <div class="flex items-center justify-between">
          <div>
            <h4 class="font-semibold">Подтвердить запись</h4>
            <p class="text-sm text-gray-600 mt-1">Проверьте дату и время, затем отправьте запрос</p>
          </div>
          <div class="text-sm text-gray-500">Шаг 1 из 1</div>
        </div>

        <div class="mt-4 text-sm text-gray-700">
          <div><strong>Дата</strong>: <span id="confirmDate">—</span></div>
          <div class="mt-2"><strong>Время</strong>: <span id="confirmTime">—</span></div>
          <div class="mt-3 text-xs text-gray-500">Все времена указаны в UTC</div>
        </div>

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
    // --- Набор дат с событиями (пример) ---
    // Формат ключей: YYYY-MM-DD (UTC)
    const events = new Set([
      // Добавьте реальные даты событий здесь
      // Примеры:
      '2025-10-03',
      '2025-10-15',
      '2025-10-25'
    ]);

    // --- DOM элементы ---
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

    // --- Текущая дата в UTC и viewDate на первый день текущего месяца UTC ---
    const now = new Date();
    let viewDate = new Date(Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), 1));
    let chosenDate = null;
    let chosenTime = null;

    function startOfMonth(d) {
      return new Date(Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), 1));
    }

    function formatDateKeyUTC(date) {
      const y = date.getUTCFullYear();
      const m = String(date.getUTCMonth() + 1).padStart(2, '0');
      const d = String(date.getUTCDate()).padStart(2, '0');
      return `${y}-${m}-${d}`;
    }

    function renderCalendar() {
      calendarEl.innerHTML = '';
      const start = startOfMonth(viewDate);
      const year = start.getUTCFullYear();
      const month = start.getUTCMonth();
      monthLabel.textContent = start.toLocaleString('ru-RU', { month: 'long', year: 'numeric', timeZone: 'UTC' });

      // первый день недели для месяца в UTC (0 Sun -> приводим к Пн..Вс)
      const firstWeekday = (new Date(Date.UTC(year, month, 1)).getUTCDay() + 6) % 7;
      const daysInMonth = new Date(Date.UTC(year, month + 1, 0)).getUTCDate();

      // пустые клетки перед первым днём
      for (let i = 0; i < firstWeekday; i++) {
        const empty = document.createElement('div');
        empty.className = 'p-3';
        calendarEl.appendChild(empty);
      }

      // диапазон подсветки (пример, можно удалить или изменить)
      const highlightStart = new Date(Date.UTC(2025, 12, 30)); // 30 Dec 2025
      const highlightEnd = new Date(Date.UTC(2025, 10, 3)); // 3 Oct 2025

      const todayUTC = new Date();
      const todayNormalized = new Date(Date.UTC(todayUTC.getUTCFullYear(), todayUTC.getUTCMonth(), todayUTC.getUTCDate()));

      for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(Date.UTC(year, month, day));
        const key = formatDateKeyUTC(date);
        const cell = document.createElement('button');
        cell.className = 'day p-3 rounded-lg text-sm text-gray-700 text-center bg-white border';
        cell.textContent = day;

        // подсветка специального диапазона (как в макете)
        if (date >= highlightStart && date <= highlightEnd) {
          cell.classList.add('bg-amber-50', 'border-amber-200', 'text-amber-700');
        } else {
          // отключаем прошлые даты
          if (date < todayNormalized) {
            cell.classList.add('unavailable');
            cell.disabled = true;
          }
        }

        // если для этой даты есть событие — пометить классом
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
          chosenTime = null;
          selectedTimeEl.textContent = '—';
          confirmTime.textContent = '—';
          confirmBtn.disabled = true;
          renderSlotsForDate(date);
        });

        calendarEl.appendChild(cell);
      }
    }

    function renderSlotsForDate(date) {
      slotsEl.innerHTML = '';
      // генерируем слоты: 09:00 — 17:30 UTC с шагом 30 минут
      const startHour = 9;
      const endHour = 17;
      const slots = [];
      for (let h = startHour; h <= endHour; h++) {
        slots.push({ h, m: 0 });
        if (!(h === endHour)) slots.push({ h, m: 30 });
        else slots.push({ h, m: 30 }); // включаем 09:30
      }

      // Пример занятых слотов (iso строки в UTC). В реальном приложении получайте с сервера
      const busyExamples = new Set([
        // Примеры:
        '2025-10-15T11:00:00Z',
        '2025-10-29T09:00:00Z',
        '2025-10-25T09:30:00Z',
        '2025-10-25T10:00:00Z',
      ]);



      slots.forEach(({h,m}) => {

          const slotDate = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), h, m));
          const iso = slotDate.toISOString().replace('.000Z','Z'); // нормализованный ключ
          const btn = document.createElement('button');
          btn.className = 'slot text-sm p-2 rounded-md border bg-white text-gray-700';
          btn.textContent = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}`;

          // debug
          // console.log('slot iso:', iso, 'busy?', busyExamples.has(iso));

          if (busyExamples.has(iso)) {
            btn.classList.add('unavailable');
            btn.disabled = true;
          }


        btn.addEventListener('click', () => {
          document.querySelectorAll('.slot').forEach(s => s.classList.remove('ring-2','ring-indigo-300','bg-indigo-50'));
          btn.classList.add('ring-2','ring-indigo-300','bg-indigo-50');
          chosenTime = iso;
          selectedTimeEl.textContent = btn.textContent + ' UTC';
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

    // --- Подтверждение (имитация отправки) ---
    confirmBtn.addEventListener('click', () => {
      if (!chosenDate || !chosenTime) return;
      confirmBtn.textContent = 'Отправлено';
      confirmBtn.disabled = true;
      setTimeout(() => {
        confirmBtn.textContent = 'Подтвердить запись';
      }, 1500);
      // Здесь добавьте реальную отправку на сервер
      // fetch('/api/book', { method: 'POST', body: JSON.stringify({ date: chosenDate, time: chosenTime }) })
    });

    // --- Инициализация: рендерим календарь и автоматически пытаемся выбрать сегодня ---
    renderCalendar();

    // попытка автоматически выбрать сегодня (если доступен)
    setTimeout(() => {
      const todayKey = String(now.getUTCDate());
      const dayButtons = Array.from(document.querySelectorAll('.day'));
      const todayBtn = dayButtons.find(b => b.textContent.trim() === todayKey && !b.disabled);
      if (todayBtn) {
        todayBtn.click();
      }
    }, 80);

    // --- Пример: как загрузить события с сервера ---
    // fetch('/api/events?month=' + viewDate.getUTCFullYear() + '-' + String(viewDate.getUTCMonth()+1).padStart(2,'0'))
    //   .then(r => r.json())
    //   .then(list => {
    //     // ожидается list = ['2024-12-30', '2024-12-31', ...]
    //     events.clear();
    //     list.forEach(d => events.add(d));
    //     renderCalendar();
    //   })
    //   .catch(() => { /* обработка ошибок */ });
  </script>
</body>
</html>