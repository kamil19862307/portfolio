<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke()
    {
        $portfolios = Portfolio::select('title', 'description', 'image')->get();

        return view('index', compact('portfolios'));
    }
}
