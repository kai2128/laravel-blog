<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(2, true);
        $categories = Category::pluck('id')->toArray();
        return [
            'title' => $title,
            'category_id' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
            'slug' => Str::slug($title),
        ];
    }
}

