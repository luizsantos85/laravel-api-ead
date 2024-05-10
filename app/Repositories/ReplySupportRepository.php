<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(ReplySupport $model) {
        $this->entity = $model;
    }

    public function createReplySupport(array $data)
    {
        $user = $this->getUserAuth();

        $reply = $this->entity
            ->create([
                'description' => $data['description'],
                'support_id' => $data['support'],
                'user_id' => $user->id,
            ]);

        return $reply;
    }
}