<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Category::factory(10)->create()->each(function ($category) {
            $category->products()->saveMany(Product::factory(rand(5,10))->make());
        });
    }
}
