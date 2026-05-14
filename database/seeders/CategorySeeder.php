<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Elettronica',
            'Abbigliamento',
            'Salute e Bellezza',
            'Casa e Giardino',
            'Motori',
            'Libri e Riviste',
            'Informatica',
            'Giochi',
            'Sport',
            'Immobili'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}