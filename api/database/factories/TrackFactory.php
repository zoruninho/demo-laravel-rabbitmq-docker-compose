<?php

namespace Database\Factories;

use App\Enums\TrackStatus;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(nbWords: 3),
            'description' => fake()->paragraph(),
            'duration' => fake()->numberBetween(30, 7200),
            'size' => fake()->numberBetween(1_000_000, 100_000_000),
            'status' => fake()->randomElement(TrackStatus::class),
            'creator_id' => User::factory(),
        ];
    }
}
