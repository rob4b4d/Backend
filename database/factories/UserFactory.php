<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'), // Default password
        ];
    }

    /**
     * Generate a user with a token.
     *
     * @return \App\Models\User
     */
    public function withToken()
    {
        // Create a user and generate a token
        return $this->afterCreating(function (User $user) {
            $user->createToken('main')->plainTextToken;
        });
    }
}
