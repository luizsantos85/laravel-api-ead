<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use UtilsTraitToken;

    public function test_lesson_unauthenticated()
    {
        $response = $this->getJson('/module/fake_id/lessons');
        $response->assertStatus(401);
    }

    public function test_get_lesson_not_found()
    {
        $response = $this->getJson('/module/fake_id/lessons', $this->defaultHeaders());
        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_get_lessons_total()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/module/{$module->id}/lessons", $this->defaultHeaders());
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_get_lessons()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);
        $response = $this->getJson("/module/{$module->id}/lessons", $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_get_lesson_show_unauthenticated()
    {
        $response = $this->getJson("/lesson/fake_id");
        $response->assertStatus(401);
    }

    public function test_get_lesson_show_not_found()
    {
        $response = $this->getJson("/lesson/fake_id", $this->defaultHeaders());
        $response->assertStatus(404);
    }


    public function test_get_lesson_show()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/lesson/{$lesson->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }





}
