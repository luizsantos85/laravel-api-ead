<?php

namespace App\Repositories;

use App\Models\Module;

/**
 * Repository montado com proposito de gerir querys complexas
 * bem como facilitar o manuseio e separação dos códigos e evolução do sistema
 */

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $model) {
        $this->entity = $model;
    }

    public function getModulesByCourseId(string $identify)
    {
        return $this->entity
            ->where('course_id', $identify)
            // ->with('lessons.views')
            ->with('lessons')
            ->get();
    }

    // public function getModule(string $identify)
    // {
    //     return $this->entity->with('lessons.views')->findOrFail($identify);
    // }
}