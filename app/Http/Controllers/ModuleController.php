<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

    public function index($courseId)
    {
        return ModuleResource::collection($this->repository->getModulesByCourseId($courseId));
    }

    // public function show($id)
    // {
    //     // $course = $this->repository->getCourse($id);
    //     return new ModuleResource($this->repository->getCourse($id));
    // }
}
