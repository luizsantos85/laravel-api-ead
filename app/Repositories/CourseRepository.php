<?php

namespace App\Repositories;

use App\Models\Course;

/**
 * Repository montado com proposito de gerir querys complexas
 * bem como facilitar o manuseio e separação dos códigos e evolução do sistema
 */

class CourseRepository
{
    protected $entity;

    public function __construct(Course $model) {
        $this->entity = $model;
    }

    public function getAllCourses()
    {
        return $this->entity
            ->with('modules.lessons')
            ->get();
    }

    public function getCourse(string $identify)
    {
        return $this->entity
            ->with('modules.lessons')
            ->findOrFail($identify);
    }
}