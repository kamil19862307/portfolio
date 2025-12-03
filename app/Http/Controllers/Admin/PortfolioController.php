<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory
    {
        $portfolios = Portfolio::all();

        return view('admin.portfolio.index', compact('portfolios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        $validated = $request->validated();

        $result = Portfolio::create($validated);

        if ($result) {
            return redirect()->route('admin.portfolio.index');

        } else{
            return redirect()->route('admin.portfolio.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
