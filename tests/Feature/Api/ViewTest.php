<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use UtilsTraitToken;

    public function test_make_view_unauthenticated()
    {
        $response = $this->postJson('/lesson/viewed');
        $response->assertStatus(401);
    }

    public function test_make_view_error_validated()
    {
        $payload = [];
        $response = $this->postJson('/lesson/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_make_view_invalid_lesson()
    {
        $payload = [
            'lesson' => 'fake_lesson'
        ];

        $response = $this->postJson('/lesson/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_make_viewed()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $payload = [
            'lesson' => $lesson->id
        ];

        $response = $this->postJson('/lesson/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(200);
    }
}
