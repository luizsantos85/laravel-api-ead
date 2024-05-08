<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
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
        // Obter IDs existentes dos cursos na base de dados
        $lessonsIds = Lesson::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        

        return [
            'status' => 'P',
            'description' => $this->faker->sentence(25),
            'lesson_id' => $this->faker->randomElement($lessonsIds),
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
