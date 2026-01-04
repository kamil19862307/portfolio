<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(): Factory|View
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->validated());

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }
}
