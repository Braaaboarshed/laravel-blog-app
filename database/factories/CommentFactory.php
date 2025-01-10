<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     *   ـ Factory.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     *   ( ).
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(), //   ( )
            'user_id' => User::factory(), //      
            'post_id' => Post::factory(), //      
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
