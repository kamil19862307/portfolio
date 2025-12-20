@extends('admin.layouts.app')

@section('title', $title ?? 'Пользователь | Посмотреть пользователя')

@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Пользователь</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> {{ $user->name }}
                </p>
                <div class="leading-loose">


                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">


                            <!-- Правая часть — предпросмотр -->
                            <div class="flex items-center justify-center">
                                <img id="preview"
                                     src="{{ $user->image_url }}"
                                     class="rounded-lg shadow-md max-h-48 object-cover"
                                     alt="Предварительный просмотр">
                            </div>

                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="title">Имя</label>
                            <label class="block text-sm text-gray-600" for="title">{{ $user->name }}</label>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="title">Роль</label>
                            <label class="block text-sm text-gray-600" for="title">{{ $user->role->label() }}</label>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="Email">Email</label>
                            <label class="block text-sm text-gray-600" for="Email">{{ $user->email }}</label>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('admin.user.index') }}">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-400 rounded"
                                        type="button">Вернуться
                                </button>
                            </a>
                        </div>
                </div>
            </div>


        </div>
    </main>
@endsection
