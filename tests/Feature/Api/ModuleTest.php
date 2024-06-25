<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use UtilsTraitToken;

    public function test_module_unauthenticated()
    {
        $response = $this->getJson('/course/fake_id/modules');
        $response->assertStatus(401);
    }

    public function test_get_module_not_found()
    {
        $response = $this->getJson('/course/fake_id/modules', $this->defaultHeaders());
        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_get_modules_total()
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/course/{$course->id}/modules", $this->defaultHeaders());
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_get_modules()
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/course/{$course->id}/modules", $this->defaultHeaders());
        $response->assertStatus(200);
    }


}
