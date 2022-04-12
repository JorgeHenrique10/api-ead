<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreViewRequest;
use App\Http\Resources\Api\LessonResource;
use App\Http\Resources\Api\ViewResouce;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public $repository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index($id)
    {
        $lessons = $this->repository->getAllLessionByModuleId($id);
        return LessonResource::collection($lessons);
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLesson($id));
    }
    public function viewed(StoreViewRequest $request)
    {
        $this->repository->markLessonViewed($request->lesson_id);
        return response()->json(['success' => true]);
    }
}
