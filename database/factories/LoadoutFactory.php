<?php

namespace Database\Factories;

use App\Models\Gun;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loadout>
 */
class LoadoutFactory extends Factory
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
            'gun_id' => Gun::factory(),
            'name' => fake()->text(25),
        ];
    }
}
