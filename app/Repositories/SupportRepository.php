<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model) {
        $this->entity = $model;
    }

    public function getSupportsAll(array $filters = [])
    {
        return $this->entity
            ->when(isset($filters['lesson']), function ($query) use ($filters) {
                $query->where('lesson_id', $filters['lesson']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['filter']), function ($query) use ($filters) {
                $filter = $filters['filter'];
                $query->where('description', 'LIKE', "%{$filter}%");
            })
            ->when(isset($filters['user']), function ($query) {
                $user = $this->getUserAuth();
                $query->where('user_id', $user->id);
            })
            ->with('replies','user','lesson')
            ->get();
    }

    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }


    public function getSupport(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }

    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()
            ->supports()
            ->create([
                'status' => $data['status'],
                'lesson_id' => $data['lesson'],
                'description' => $data['description'],
            ]);

        return $support;
    }


    public function createReplySupport(string $identify, array $data)
    {
        $user = $this->getUserAuth();

        $reply = $this->getSupport($identify)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id
            ]);

        return $reply;

    }
}