<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Factory;
use Illuminate\View\View;
use function PHPUnit\Framework\isInt;
use function PHPUnit\Framework\isString;

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
    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!isset($validated['slug'])) {

            // Есди слаг не задан, берём его из тайтла
            $slug = Str::slug($validated['title']);

            $validated['slug'] = $slug;
        } else {

            $slug = Str::slug($validated['slug']);
        }

        // Загружаем картинку
        if ($request->hasFile('image')) {

            $name = $slug . '.' . $request->file('image')->getClientOriginalExtension();

            $validated['image'] = $name;

            $path = $request->file('image')->storeAs('images/portfolio', $name, 'public');
        }

        $result = Portfolio::create($validated);

        if ($result) {
            return redirect()->route('admin.portfolio.index')->with('success', 'Запись успешно создана');

        } else{
            return redirect()->route('admin.portfolio.create')->with('error', 'Новая запись не создана');
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
    public function destroy(int $id): RedirectResponse
    {
        $portfolio = Portfolio::where('id', $id)->firstOrFail();

        if ($portfolio) {

            $portfolio->delete();

            return redirect()->route('admin.portfolio.index')->with('success', 'Запись удалена');

        } else {

            return redirect()->route('admin.portfolio.index')->with('error', 'Не получилось удалить');
        }
    }
}
