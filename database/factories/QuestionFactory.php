<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "question" => $this->faker->sentence(),
            "category" => $this->faker->randomElement(['Numeric', 'Verbal', 'Logika']),
            "option_a" => $this->faker->word(),
            "option_b" => $this->faker->word(),
            "option_c" => $this->faker->word(),
            "option_d" => $this->faker->word(),
            "correct_answer" => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
