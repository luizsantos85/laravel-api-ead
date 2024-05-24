<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

/**
 * Repository montado com proposito de gerir querys complexas
 * bem como facilitar o manuseio e separação dos códigos e evolução do sistema
 */

class LessonRepository
{
    use RepositoryTrait;

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

    public function markLessonViewed(string $identify)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $identify)->first();

        if($view){
            return $view->update([
                "qtd" => $view->qtd + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $identify
        ]);
    }
}