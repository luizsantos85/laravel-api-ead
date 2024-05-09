<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\ReplyResource;
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

    public function store(StoreSupportRequest $request)
    {
        $support = $this->repository->createNewSupport($request->validated());

        return new SupportResource($support);
    }

    public function createReply($id, StoreReplySupportRequest $request)
    {
        $reply = $this->repository->createReplySupport($id, $request->validated());

        return new ReplyResource($reply);
    }

}
