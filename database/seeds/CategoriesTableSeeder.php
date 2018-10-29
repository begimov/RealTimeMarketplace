<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Категория 1',
            'Категория 2'
        ];

        collect($categories)->each(function ($name, $index) {
            Category::create([
                'name' => $name,
            ]);
        });
    }
}
