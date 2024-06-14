<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'is_upvote' => fake()->boolean(),
        ];
    }

    public function upvote(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_upvote' => true,
        ]);
    }

    public function downvote(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_upvote' => false,
        ]);
    }
}
