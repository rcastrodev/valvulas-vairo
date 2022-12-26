<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'order'             => 'A1',
            'image'             => 'images/category/Rectangle4089.png',
            'name'              => 'Válvulas Esclusas',
        ]);

        Category::create([
            'order'             => 'A2',
            'image'             => 'images/category/Rectangle074089.png',
            'name'              => 'Válvulas Globo',
        ]);

        Category::create([
            'order'             => 'A3',
            'image'             => 'images/category/Rectangle40899.png',
            'name'              => 'Válvulas Retención',
        ]);

        Category::create([
            'order'             => 'A4',
            'image'             => 'images/category/Rectangle408901.png',
            'name'              => 'Válvulas Esféricas',
        ]);

        Category::create([
            'order'             => 'A5',
            'image'             => 'images/category/Rectangle034089.png',
            'name'              => 'Válvulas Extra Chatas',
        ]);

        Category::create([
            'order'             => 'A6',
            'image'             => 'images/category/Rectangle024089.png',
            'name'              => 'Válvulas Mariposa',
        ]);

        Category::create([
            'order'             => 'A7',
            'image'             => 'images/category/Rectangle014089.png',
            'name'              => 'Válvulas Forjadas',
        ]);

    }
}
