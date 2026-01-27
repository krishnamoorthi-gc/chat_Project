<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender',
        'message',
        'file_path',
        'file_type',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
