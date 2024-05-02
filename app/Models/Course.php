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
}
