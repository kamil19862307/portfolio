@extends('admin.layouts.app')

@section('title', $title ?? 'Портфолио | Посмотреть проект')

@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Портфолио</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> {{ $portfolio->title }}
                </p>
                <div class="leading-loose">


                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">


                            <!-- Правая часть — предпросмотр -->
                            <div class="flex items-center justify-center">
                                <img id="preview"
                                     src="{{ asset('storage/images/portfolio/' . $portfolio->image) }}"
                                     class="rounded-lg shadow-md max-h-48 object-cover"
                                     alt="Предварительный просмотр">
                            </div>

                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="title">Название</label>

                            <input class="w-full px-5 py-1 text-gray-700 @error('title') border-2 border-red-400 @enderror bg-gray-200 rounded"
                                   id="title"
                                   name="title"
                                   type="text"
                                   value="{{ $portfolio->title }}"
                                   aria-label="Title">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="slug">Слаг</label>
                            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded"
                                   id="slug"
                                   name="slug"
                                   type="text"
                                   value="{{ $portfolio->slug }}"
                                   aria-label="Slug">
                        </div>
                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="description">Описание</label>
                            <textarea
                                class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="description"
                                name="description" rows="6"
                                aria-label="Description">{{ $portfolio->description }}</textarea>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('admin.portfolio.index') }}">
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
