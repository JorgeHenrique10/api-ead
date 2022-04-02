<?php

namespace Database\Factories\Api;

use App\Models\Api\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lesson_id' => Lesson::factory(),
            'user_id' => User::factory(),
            'status' => 'P',
            'description' => $this->faker->sentence(20)
        ];
    }
}
