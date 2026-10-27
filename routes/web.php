<?php

use App\Http\Controllers\RecipePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipePageController::class, 'index'])->name('home');
Route::post('/recipes', [RecipePageController::class, 'store'])->name('recipes.store');
Route::delete('/recipes/{recipe}', [RecipePageController::class, 'destroy'])->name('recipes.destroy');
