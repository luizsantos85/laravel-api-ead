<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplyResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $replySupportrepository)
    {
        $this->repository = $replySupportrepository;
    }

    public function createReply(StoreReplySupportRequest $request)
    {
        $reply = $this->repository->createReplySupport($request->validated());

        return new ReplyResource($reply);
    }
}
