<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Obter IDs existentes dos cursos na base de dados
        $courseIds = Course::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'course_id' => $this->faker->randomElement($courseIds),
        ];
    }
}
