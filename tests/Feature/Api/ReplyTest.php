<?php

namespace Tests\Feature\Api;

use App\Models\Api\Lesson;
use App\Models\Api\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Trait\UtilsTrait;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use UtilsTrait;

    public function test_reply_unauthorized()
    {
        $response = $this->postJson('/reply');

        $response->assertStatus(401);
    }

    public function test_reply_fail()
    {

        $user = $this->getUser();
        $lesson = Lesson::factory()->create();
        $support = Support::factory()->create(['lesson_id' => $lesson->id]);

        $payload = [
            'support_id' => $support->id . 'fail',
            'description' => 'Teste Resposta Suporte'
        ];



        $response = $this->postJson('/reply', $payload, $this->getHeader($user));

        $response->assertStatus(422);
    }

    public function test_reply()
    {

        $user = $this->getUser();
        $lesson = Lesson::factory()->create();
        $support = Support::factory()->create(['lesson_id' => $lesson->id]);

        $payload = [
            'support_id' => $support->id,
            'description' => 'Teste Resposta Suporte'
        ];



        $response = $this->postJson('/reply', $payload, $this->getHeader($user));

        $response->assertStatus(201);
    }
}
