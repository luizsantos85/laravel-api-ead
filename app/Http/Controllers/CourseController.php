<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        // $courses = $this->repository->getAllCourses();
        return CourseResource::collection($this->repository->getAllCourses());
    }

    public function show($id)
    {
        // $course = $this->repository->getCourse($id);
        return new CourseResource($this->repository->getCourse($id));
    }
}
