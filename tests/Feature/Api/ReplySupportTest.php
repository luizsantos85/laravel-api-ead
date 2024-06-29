<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use UtilsTraitToken, UtilsTraitLessonCreate;

    public function test_reply_support_unauthenticated()
    {
        $response = $this->postJson('/support/reply');
        $response->assertStatus(401);
    }

    public function test_create_reply_support_error_validated()
    {
        $response = $this->postJson('/support/reply', [], $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $user = $this->createUser();
        $lesson = $this->createLesson();

        $support = Support::factory()->create(['user_id' => $user->id, 'lesson_id' => $lesson->id]);

        $payload = [
            'description' => 'testeeee',
            'support' => $support->id
        ];

        $response = $this->postJson('/support/reply', $payload, $this->defaultHeaders());
        $response->assertStatus(201);
    }
}
