<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LearningTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LearningTime>
 */
class LearningTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'learning_time' => fake()->numberBetween(0, 12),
            'learning_time_date' => fake()->dateTimeBetween('-3 month', 'now'),
            'user_id' => '8bf22827-6ab1-4e1f-8cd6-69e41d9d78d7',
        ];
    }
}
