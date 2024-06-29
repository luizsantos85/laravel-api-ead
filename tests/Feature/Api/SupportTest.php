<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTraitToken, UtilsTraitLessonCreate;

    public function test_supports_user_unauthenticated()
    {
        $response = $this->getJson('/supports/user');
        $response->assertStatus(401);
    }

    public function test_get_supports_user()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $token = $user2->createToken('teste')->plainTextToken;

        $lesson = $this->createLesson();

        Support::factory()->count(20)->create(['user_id' => $user1->id, 'lesson_id' => $lesson->id ]);
        Support::factory()->count(2)->create([ 'user_id' => $user2->id, 'lesson_id' => $lesson->id ]);

        $response = $this->getJson('/supports/user', [
            "Authorization" => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_supports_unauthenticated()
    {
        $response = $this->getJson('/supports');
        $response->assertStatus(401);
    }

    public function test_get_supports()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $lesson = $this->createLesson();

        Support::factory()->count(20)->create(['user_id' => $user1->id, 'lesson_id' => $lesson->id ]);
        Support::factory()->count(20)->create([ 'user_id' => $user2->id, 'lesson_id' => $lesson->id ]);

        $response = $this->getJson('/supports', $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(40, 'data');
    }


    //é possivel criar outros testes de filtros com esse modelo
    public function test_get_supports_filter_lesson()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $lesson = $this->createLesson();
        $lesson2 = $this->createLesson();

        Support::factory()->count(20)->create(['user_id' => $user1->id, 'lesson_id' => $lesson2->id ]);
        Support::factory()->count(10)->create([ 'user_id' => $user2->id, 'lesson_id' => $lesson->id ]);

        $payload = ['lesson' => $lesson->id];

        $response = $this->json('GET','/supports',$payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_create_support_unauthenticated()
    {
        $response = $this->postJson('/support');
        $response->assertStatus(401);
    }

    public function test_create_support_error_validated()
    {
        $response = $this->postJson('/support',[], $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $lesson = $this->createLesson();

        $payload = [
            'lesson' => $lesson->id,
            'status' => 'P',
            'description' => 'testeeee'
        ];

        $response = $this->postJson('/support',$payload, $this->defaultHeaders());
        $response->assertStatus(201);
    }




}
