<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatbot_id',
        'lead_id',
        'session_id',
        'status',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function chatbot()
    {
        return $this->belongsTo(Chatbot::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
