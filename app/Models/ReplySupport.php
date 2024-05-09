<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $table = 'reply_support';

    protected $fillable = [
        'description',
        'support_id',
        'user_id'
    ];


    public function support()
    {
        return $this->belongsTo(Support::class, 'support_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
