<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'user_name'     => fake()->name(),
            'user_email'    => fake()->unique()->safeEmail(),
            'user_password' => static::$password ??= Hash::make('password'),
            'user_address'  => fake()->address(),
            'user_phone'    => fake()->phoneNumber(),
            'user_role'     => 'user',
        ];
    }
}