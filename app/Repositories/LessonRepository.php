<?php

namespace App\Repositories;

use App\Models\Api\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;
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

    public function markLessonViewed($lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qty' => $view->qty + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId,
        ]);
    }
}
