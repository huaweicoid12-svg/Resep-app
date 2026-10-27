<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'country',
        'ingredients',
        'instructions',
    ];

    /** Bahan: satu baris = satu bahan. */
    public function ingredientList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->ingredients))));
    }

    /** Langkah: satu baris = satu langkah (nomor di depan dibuang). */
    public function stepList(): array
    {
        $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->instructions)));

        return array_values(array_map(fn ($l) => preg_replace('/^\d+[\.\)]\s*/', '', $l), $lines));
    }
}
