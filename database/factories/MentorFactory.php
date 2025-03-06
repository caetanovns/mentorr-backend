<?php

namespace Database\Factories;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $diff = User::all()->pluck('id')->diffKeys(Mentor::all()->pluck('user_id'));

        return [
            'position' => fake()->jobTitle(),
            'company' => fake()->company(),
            'resume' => fake()->text($maxNbChars = 100),
            'biography' => fake()->paragraphs($nb = 3, $asText = true),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 50),
            'rating' => fake()->numberBetween($min = 1, $max = 5),
            'user_id' => fake()->randomElement($diff)
        ];
    }
}
