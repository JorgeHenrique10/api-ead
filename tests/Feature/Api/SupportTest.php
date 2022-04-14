<?php

namespace Tests\Feature\Api;

use App\Models\Api\Lesson;
use App\Models\Api\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Trait\UtilsTrait;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_supports_unauthorized()
    {
        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }

    public function test_get_all_supports()
    {
        $response = $this->getJson('/supports', $this->getHeader($this->getUser()));

        $response->assertStatus(200);
    }

    public function test_get_all_supports_total()
    {
        $supports = Support::factory()->count(10)->create();

        $response = $this->getJson('/supports', $this->getHeader($this->getUser()));

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_get_all_supports_my_fail()
    {
        $user = $this->getUser();

        Support::factory()->count(10)->create(['user_id' => $user->id]);

        $response = $this->getJson('/supports/my');

        $response->assertStatus(401);
    }
    public function test_get_all_supports_my()
    {
        $user = $this->getUser();

        Support::factory()->count(10)->create(['user_id' => $user->id]);

        $response = $this->getJson('/supports/my', $this->getHeader($user));

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_get_all_supports_my_filter_fail()
    {
        $user = $this->getUser();

        Support::factory()->count(10)->create(['user_id' => $user->id]);
        $response = $this->getJson('/supports/my?status=A', $this->getHeader($user));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_get_all_supports_my_filter()
    {
        $user = $this->getUser();

        Support::factory()->count(10)->create(['user_id' => $user->id]);
        $response = $this->getJson('/supports/my?status=P', $this->getHeader($user));

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_insert_support_fail()
    {
        $user = $this->getUser();
        $lesson = Lesson::factory()->create();
        $payload = [
            'lesson_id' => $lesson->id,
            'description' => 'Teste Description'
        ];

        Support::factory()->count(10)->create(['user_id' => $user->id]);
        $response = $this->postJson('/supports', [], $this->getHeader($user));

        $response->assertStatus(422);
    }

    public function test_insert_support()
    {
        $user = $this->getUser();
        $lesson = Lesson::factory()->create();
        $payload = [
            'lesson_id' => $lesson->id,
            'description' => 'Teste Description',
            'status' => 'P'
        ];

        Support::factory()->count(10)->create(['user_id' => $user->id]);
        $response = $this->postJson('/supports', $payload, $this->getHeader($user));
        // $response->dump();
        $response->assertStatus(201);
    }
}
