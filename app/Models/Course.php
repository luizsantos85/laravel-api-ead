<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;     //não é autoincremento
    protected $keyType = 'uuid';    //tipo da chave
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }
}
