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
        $user = $this->getUserAuth();
        
        return $this->entity->with('lesson', 'user')
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
            ->where('user_id', $user->id)
            ->get();

        // return $this->getUserAuth()
        //     ->supports()
        //     ->when(isset($filters['lesson']), function ($query) use ($filters) {
        //         $query->where('lesson_id', $filters['lesson']);
        //     })
        //     ->when(isset($filters['status']), function ($query) use ($filters) {
        //         $query->where('status', $filters['status']);
        //     })
        //     ->when(isset($filters['filter']), function ($query) use ($filters) {
        //         $filter = $filters['filter'];
        //         $query->where('description', 'LIKE', "%{$filter}%");
        //     })
        //     ->get();
    }

    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }
}