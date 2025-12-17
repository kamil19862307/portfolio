@extends('admin.layouts.app')

@section('title', $title ?? 'Пользователи')

@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Пользователи</h1>

        <a href="{{ route('admin.user.create') }}">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-500 rounded" type="submit">Добавить пользователя</button>
        </a>

        <x-alert />

        <div class="w-full mt-12">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Пользователи
            </p>

            <div class="bg-white overflow-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Название проекта
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Rol
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Создан
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Статус
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Изменить
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Удалить
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)

                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full"
                                                 src="{{ $user->image_url }}"
                                                 alt=""/>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <a href="{{ route('admin.portfolio.show', $user->id) }}">
                                                    {{ $user->name }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Admin</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $user->created_at->format('d-m-Y') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Активный</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ route('admin.portfolio.edit', $user->id) }}">
                                        <button
                                            class="px-4 py-1 text-white font-light tracking-wider bg-gray-400 rounded"
                                            type="button">
                                            Изменить
                                        </button>
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="{{ route('admin.portfolio.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Точно удалить?')">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="px-4 py-1 border-1 border-red-400 text-red-400 font-light tracking-wider bg-white rounded"
                                            type="submit">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </main>
@endsection
