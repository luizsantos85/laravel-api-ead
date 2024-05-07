<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->getSupportsAll($request->all());

        return SupportResource::collection($supports);
    }

}
