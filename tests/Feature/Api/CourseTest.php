<?php

namespace Tests\Feature\Api;

use App\Models\Api\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Trait\UtilsTrait;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use UtilsTrait;
    public function test_get_all_courses_unauthorized()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses', $this->getHeader());

        $response->assertStatus(200);
    }

    public function test_get_all_courses_total()
    {
        $courses = Course::factory()->count(10)->create();

        $response = $this->getJson('/courses', $this->getHeader());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_single_courses_unauthorized()
    {
        $response = $this->getJson('/courses/fake_id');

        $response->assertStatus(401);
    }

    public function test_get_single_courses_total()
    {
        $courses = Course::factory()->create();

        $response = $this->getJson("/courses/{$courses->id}", $this->getHeader());

        $response->assertStatus(200);
    }
}
