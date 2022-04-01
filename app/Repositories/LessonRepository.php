<?php

namespace App\Repositories;

use App\Models\Api\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getAllLessionByModuleId($moduleId)
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->get();
    }
    public function getLesson($id)
    {
        return $this->entity->findOrFail($id);
    }
}
