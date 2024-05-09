<?php

namespace App\Repositories;

use App\Models\Lesson;

/**
 * Repository montado com proposito de gerir querys complexas
 * bem como facilitar o manuseio e separação dos códigos e evolução do sistema
 */

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $model) {
        $this->entity = $model;
    }

    public function getLessonsByModuleId(string $identify)
    {
        return $this->entity
            ->where('module_id', $identify)
            ->with('supports.replies')
            ->get();
    }

    public function getLesson(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }
}