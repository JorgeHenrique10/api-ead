<?php

namespace Tests\Feature\Api;

use App\Models\Api\Lesson;
use App\Models\Api\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Trait\UtilsTrait;
use Tests\TestCase;

class LessionTest extends TestCase
{
    use UtilsTrait;

    public function test_lesson_unauthenticated()
    {
        $response = $this->getJson('/lessons/fake_id');

        $response->assertStatus(401);
    }
    public function test_get_single_lesson_by_id()
    {

        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->getHeader($this->getUser()));

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'module_id', 'name', 'url', 'video', 'description', 'created_at', 'updated_at']]);
    }

    public function test_get_single_lessons_by_modulesId_fail()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/modules/fake_id/lessons", $this->getHeader($this->getUser()));
        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_single_lessons_by_modulesId()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->count(10)->create(['module_id' => $module->id]);

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->getHeader($this->getUser()));
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_insert_viewed_fail()
    {
        $lesson = Lesson::factory()->create();
        $response = $this->postJson("lessons/viewed", [], $this->getHeader($this->getUser()));
        $response->assertStatus(422);
    }

    public function test_insert_viewed()
    {
        $lesson = Lesson::factory()->create();
        $response = $this->postJson("lessons/viewed", ['lesson_id' => $lesson->id], $this->getHeader($this->getUser()));
        $response->assertStatus(200)
            ->assertExactJson(['success' => true]);
    }
}
