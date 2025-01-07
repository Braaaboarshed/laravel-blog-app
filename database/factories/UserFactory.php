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
            'name' => $this->faker->name, // توليد اسم عشوائي
            'email' => $this->faker->unique()->safeEmail, // توليد بريد إلكتروني فريد
            'is_admin' => $this->faker->boolean(10), // احتمالية 10% أن يكون المستخدم أدمن
            'password' => Hash::make('password'), // تشفير كلمة المرور
            'image' => $this->faker->optional()->imageUrl(100, 100, 'people', true, 'User Image'), // توليد صورة وهمية أو null
        ];
    }
}
