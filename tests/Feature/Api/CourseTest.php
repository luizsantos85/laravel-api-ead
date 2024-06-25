<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use UtilsTraitToken;

    public function test_course_unauthenticated()
    {
        $response = $this->getJson('/courses');
        $response->assertStatus(401);
    }

    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses', $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_get_courses_total()
    {
        Course::factory()->count(10)->create();
        $response = $this->getJson('/courses', $this->defaultHeaders());
        $response->assertStatus(200)
            ->assertJsonCount(10,'data');
    }

    public function test_unauthenticated_course()
    {
        $response = $this->getJson('/course/fake_id');
        $response->assertStatus(401);
    }

    public function test_get_course_not_found()
    {
        $response = $this->getJson('/course/fake_id', $this->defaultHeaders());
        $response->assertStatus(404);
    }

    public function test_get_course()
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/course/{$course->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }



}
