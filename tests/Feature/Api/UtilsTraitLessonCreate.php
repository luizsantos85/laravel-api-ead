<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;

trait UtilsTraitLessonCreate
{
    use UtilsTraitToken;


    public function createLesson()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        return $lesson;
    }


}

