<?php

namespace App\Http\Controllers;

use App\Facades\Cbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function show(): View
    {
        // Получаем актуальный курс доллара
        $currentUsd = Cbr::getUsd();

        return view('blog', compact('currentUsd'));
    }
}
