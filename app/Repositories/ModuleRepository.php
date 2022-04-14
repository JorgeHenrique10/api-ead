<?php

namespace App\Repositories;

use App\Models\Api\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $model)
    {
        $this->entity = $model;
    }

    public function getAllModuleCourseId($courseId)
    {
        return $this->entity
            ->with('lessons.views')
            ->where('course_id', $courseId)
            ->get();
    }
}
