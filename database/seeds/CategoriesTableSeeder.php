<?php

use App\Category;
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
        Category::create([
            'nama' => "Makanan"
        ]);
        Category::create([
            'nama' => "Minuman"
        ]);
        Category::create([
            'nama' => "Elektronik"
        ]);
        Category::create([
            'nama' => "Perkakas"
        ]);
        Category::create([
            'nama' => "Lain-lain"
        ]);
    }
}
