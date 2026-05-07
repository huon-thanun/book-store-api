<?php

namespace Database\Factories;

use App\Models\BookDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookDetail>
 */
class BookDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'publisher' => $this->faker->paragraph(),
            'language' => $this->faker->randomElement(['Khmer', 'English', 'French']),
            'page_count' => $this->faker->numberBetween(100, 500),
        ];
    }
}
