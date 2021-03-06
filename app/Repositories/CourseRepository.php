<?php

namespace App\Repositories;

use App\Models\Api\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $model)
    {
        $this->entity = $model;
    }

    public function getAllCourses()
    {
        return $this->entity->with('modules.lessons')->get();
    }
    public function getCourse($id)
    {
        return $this->entity->findOrFail($id);
    }
}
