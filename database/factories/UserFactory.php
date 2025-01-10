<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name, //   
            'email' => $this->faker->unique()->safeEmail, //    
            'is_admin' => $this->faker->boolean(10), //  10%    
            'password' => Hash::make('password'), //   
            'image' => $this->faker->optional()->imageUrl(100, 100, 'people', true, 'User Image'), //     null
        ];
    }
}
