<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Obter IDs existentes dos cursos na base de dados
        $modulesId = Module::pluck('id')->toArray();
        $name = $this->faker->name();

        return [
            'name' => $name,
            'url' => str()->slug($name),
            'video' => str()->random(),
            'module_id' => $this->faker->randomElement($modulesId),
        ];
    }
}
