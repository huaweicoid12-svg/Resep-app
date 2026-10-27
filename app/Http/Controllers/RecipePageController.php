<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipePageController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $country = trim((string) $request->query('country', ''));

        $recipes = Recipe::query()
            ->when($q !== '', function ($query) use ($q) {
                $like = '%'.mb_strtolower($q).'%';
                $query->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(name) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(ingredients) LIKE ?', [$like]);
                });
            })
            ->when($country !== '', fn ($query) => $query->where('country', $country))
            ->latest('id')
            ->get();

        return view('recipes.index', [
            'recipes' => $recipes,
            'countries' => Recipe::query()->distinct()->orderBy('country')->pluck('country'),
            'total' => Recipe::count(),
            'q' => $q,
            'country' => $country,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'ingredients' => ['required', 'string', 'max:5000'],
            'instructions' => ['required', 'string', 'max:10000'],
        ]);

        Recipe::create($data);

        return redirect()->route('home')->with('status', 'Resep "'.$data['name'].'" berhasil ditambahkan.');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        $recipe->delete();

        return redirect()->route('home')->with('status', 'Resep "'.$recipe->name.'" dihapus.');
    }
}
