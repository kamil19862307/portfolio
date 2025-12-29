<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterStoreRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(): Factory|View
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        dd($request);
    }
}
