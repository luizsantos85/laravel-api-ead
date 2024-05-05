<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;     //não é autoincremento
    protected $keyType = 'uuid';    //tipo da chave

    protected $fillable = ['name', 'description', 'url', 'video'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
