<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,11),
            'score_numeric' => $this->faker->numberBetween(1,100),
            'score_verbal' => $this->faker->numberBetween(1,100),
            'score_logika' => $this->faker->numberBetween(1,100),
            'result' => $this->faker->randomElement(['Passed','Failed']),
        ];
    }
}
