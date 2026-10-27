<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    private function rules(bool $partial = false): array
    {
        $req = $partial ? 'sometimes' : 'required';

        return [
            'name' => [$req, 'string', 'max:255'],
            'country' => [$req, 'string', 'max:255'],
            'ingredients' => [$req, 'string'],
            'instructions' => [$req, 'string'],
        ];
    }

    public function index()
    {
        return response()->json([
            "status" => "success",
            "data" => Recipe::all()
        ]);
    }

    public function show($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json([
                "status" => "error",
                "message" => "Data not found"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $recipe
        ]);
    }

    public function store(Request $request)
    {
        $recipe = Recipe::create($request->validate($this->rules()));

        return response()->json([
            "status" => "success",
            "message" => "Recipe created",
            "data" => $recipe
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json([
                "status" => "error",
                "message" => "Data not found"
            ], 404);
        }

        $recipe->update($request->validate($this->rules(true)));

        return response()->json([
            "status" => "success",
            "message" => "Recipe updated",
            "data" => $recipe
        ]);
    }

    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json([
                "status" => "error",
                "message" => "Data not found"
            ], 404);
        }

        $recipe->delete();

        return response()->json([
            "status" => "success",
            "message" => "Recipe deleted"
        ]);
    }
}