<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;


trait UuidTrait
{
    public static function booted()
    {
        //Como esta sendo usado uuid como chave primaria no BD
        //Cria uma chave "primaria" uuid automatica
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
