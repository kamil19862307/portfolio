@extends('admin.layouts.app')

@section('title', $title ?? 'Пользователи | Изменить пользователя')

@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Пользователь</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Изменить пользователя
                </p>
                <div class="leading-loose">
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.user.update', $user) }}"
                          class="p-10 bg-white rounded shadow-xl">

                        @method('PUT')

                        @csrf

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Левая часть — инпут загрузки -->
                            <div>
                                <label class="block text-sm text-gray-600" for="image">Изображение</label>

                                @error('image')
                                <label class="block text-sm text-red-400">{{ $message }}</label>
                                @enderror

                                <p class="text-xs text-gray-500 mt-1">
                                    Поддерживаемые форматы: jpg, jpeg, png, webp
                                </p>

                                <input
                                        class="w-full px-5 py-2 mt-1 bg-gray-200 rounded
                                        text-gray-700 @error('image') border-2 border-red-400 @enderror"
                                        id="image"
                                        name="image"
                                        type="file"
                                        accept="image/*"
                                        onchange="previewImage(event)"
                                >
                            </div>

                            <!-- Правая часть — предпросмотр -->
                            <div class="flex items-center justify-center">
                                <img id="preview"
                                     src="{{ $user->image_url }}"
                                     class="rounded-lg shadow-md max-h-48 object-cover"
                                     alt="Предварительный просмотр">
                            </div>

                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="name">Имя</label>
                            @error('name')
                                <label class="block text-sm text-red-400" for="name">{{ $message }}</label>
                            @enderror
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded
                                   @error('name') border-2 border-red-400 @enderror"
                                   id="name"
                                   name="name"
                                   type="text"
                                   required=""
                                   value="{{ $user->name }}"
                                   placeholder="{{ $user->name }}"
                                   aria-label="Name">
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="slug">Email</label>
                            @error('email')
                                <label class="block text-sm text-red-400" for="email">{{ $message }}</label>
                            @enderror
                            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded
                                   @error('email') border-2 border-red-400 @enderror"
                                   id="email"
                                   name="email"
                                   type="text"
                                   value="{{ $user->email }}"
                                   aria-label="Email">
                        </div>

                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="description">Роль</label>

                            <select
                                id="role"
                                name="role"
                                class="peer block w-full appearance-none rounded-xl border
                                bg-gray-200 px-4 py-3 pr-10 text-gray-600 shadow-sm
                                @error('role')
                                    border-red-400
                                @enderror
                                focus:outline-none focus:ring-2"
                                >

                                @foreach($roles as $role)
                                    <option value="{{ $role->value }}"
                                            @selected(old('role', $user->role->value) === $role->value)
                                    >
                                        {{ $role->label() }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password">Пароль</label>
                            @error('password')
                            <label class="block text-sm text-red-400" for="password">{{ $message }}</label>
                            @enderror
                            <input class="w-full px-5 py-1 text-gray-700 @error('password') border-2 border-red-400 @enderror bg-gray-200 rounded"
                                   id="password" name="password" type="text" value="{{ old('password') }}"
                                   placeholder="Пароль"
                                   aria-label="Password">
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password_confirmation">Пароль ещё раз</label>
                            @error('password_confirmation')
                            <label class="block text-sm text-red-400" for="password_confirmation">{{ $message }}</label>
                            @enderror
                            <input class="w-full px-5 py-1 text-gray-700 @error('password_confirmation') border-2 border-red-400 @enderror bg-gray-200 rounded"
                                   id="password_confirmation" name="password_confirmation" type="text" value="{{ old('password_confirmation') }}"
                                   placeholder="Подтверждение пароля"
                                   aria-label="Password_confirmation">
                        </div>

                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-400 rounded"
                                    type="submit">
                                Сохранить
                            </button>
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-red-400 rounded"
                                    type="reset">
                                Сбросить
                            </button>
                            <a href="{{ route('admin.user.index') }}">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-400 rounded"
                                        type="button">
                                    Вернуться
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </main>
@endsection
