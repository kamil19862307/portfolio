@extends('admin.layouts.app')

@section('title', $title ?? 'Портфолио | Добавить проект')

@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Портфолио</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Добавить проекта
                </p>
                <div class="leading-loose">
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.portfolio.store') }}"
                          class="p-10 bg-white rounded shadow-xl">

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
                                     src="{{ asset('images/no_image.png') }}"
                                     class="rounded-lg shadow-md max-h-48 object-cover"
                                     alt="Предварительный просмотр">
                            </div>

                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="title">Название</label>
                            @error('title')
                            <label class="block text-sm text-red-400" for="title">{{ $message }}</label>
                            @enderror
                            <input class="w-full px-5 py-1 text-gray-700 @error('title') border-2 border-red-400 @enderror bg-gray-200 rounded"
                                   id="title" name="title" type="text" required="" value="{{ old('title') }}"
                                   placeholder="Название проекта"
                                   aria-label="Title">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="slug">Слаг</label>
                            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="slug" name="slug"
                                   type="text"
                                   placeholder="Если не заполнять, значение возмётся из названия проекта"
                                   aria-label="Slug">
                        </div>
                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="description">Описание</label>
                            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="description"
                                      name="description" rows="6" required="" placeholder="Описание проекта.."
                                      aria-label="Description"></textarea>
                        </div>
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-400 rounded"
                                    type="submit">Сохранить
                            </button>
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-red-400 rounded"
                                    type="reset">Сбросить
                            </button>
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-400 rounded"
                                    type="button">Вернуться
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </main>
@endsection
