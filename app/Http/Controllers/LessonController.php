<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index($moduleId)
    {
        return LessonResource::collection($this->repository->getLessonsByModuleId($moduleId));
    }

    public function show($lessonId)
    {
        return new LessonResource($this->repository->getLesson($lessonId));
    }
}
