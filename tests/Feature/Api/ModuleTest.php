<?php

namespace Tests\Feature\Api;

use App\Models\Api\Course;
use App\Models\Api\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Trait\UtilsTrait;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use UtilsTrait;
    public function test_modules_unauthorized()
    {
        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }

    public function test_get_all_modules_by_course_id()
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create(['course_id' => $course->id]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->getHeader());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
}
