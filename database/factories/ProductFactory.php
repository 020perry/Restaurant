<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'bio' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
