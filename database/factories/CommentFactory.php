<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * اسم نموذج الـ Factory.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * تعريف النموذج (البيانات الوهمية).
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(), // محتوى التعليق (جملة عشوائية)
            'user_id' => User::factory(), // استخدام مصنع لإنشاء مستخدم وهمي عشوائي
            'post_id' => Post::factory(), // استخدام مصنع لإنشاء منشور وهمي عشوائي
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
