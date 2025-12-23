<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View
    {
        $title = 'Все пользователи';

        $users = User::all();

        return view('admin.user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        $title = 'Создание пользователя';

        $roles = Role::cases();

        return view('admin.user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('images/user', $fileName, 'public');

            $data['image'] = $fileName;

        }

        User::query()->create($data);

        return redirect()->route('admin.user.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Factory|View
    {
        $title = 'Посмотреть пользователя';

        return view('admin.user.show', compact('user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Factory|View
    {
        $title = 'Изменить данные пользователя';

        $roles = Role::cases();

        return view('admin.user.edit', compact('user', 'title', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        // Если есть новая кртинка, то удаляем старую и загружаем новую, только не трогаем дефолтную
        if ($request->hasFile('image')) {

            if ($user->image

                && $user->image !== 'no_image.png'

                && Storage::disk('public')->exists('images/user/' . $user->image)) {

                Storage::disk('public')->delete('images/user/' . $user->image);

            }

                $file = $request->file('image');

                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $validated['image'] = $fileName;

                $file->storeAs('images/user/', $fileName,  'public');

        } else {

            $validated['image'] = $user->image;

        }

        // Если не введён новый пароль, то оставляем старый
        if (filled($validated['password'])) {

            $validated['password'] = Hash::make($validated['password']);

        } else {

            unset($validated['password']);

        }

        $user->update($validated);

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}
