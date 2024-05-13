<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getSupportsUser(array $filters = [])
    {
        $filters['user'] = true;
        return $this->getSupportsAll($filters);
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
            ->with('replies', 'user', 'lesson')
            ->orderByDesc('updated_at')
            ->get();
    }

    private function getSupport(string $identify)
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
}
