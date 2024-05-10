<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->getSupportsAll($request->all());

        return SupportResource::collection($supports);
    }

    public function store(StoreSupportRequest $request)
    {
        $support = $this->repository->createNewSupport($request->validated());

        return new SupportResource($support);
    }


}
