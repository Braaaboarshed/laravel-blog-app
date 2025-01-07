<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // عنوان وهمي
            'content' => $this->faker->paragraph, // محتوى وهمي
            'user_id' => User::factory(), // استخدام Factory لتوليد مستخدم وهمي
            'category_id' => Category::factory(), // استخدام Factory لتوليد صنف وهمي
        ];
    }
}
