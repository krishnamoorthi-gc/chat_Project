<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeSource extends Model
{
    protected $fillable = [
        'chatbot_id',
        'type',
        'title',
        'content',
        'file_path',
        'status',
        'error_message',
    ];

    public function chatbot()
    {
        return $this->belongsTo(Chatbot::class);
    }

    public function chunks()
    {
        return $this->hasMany(KnowledgeChunk::class, 'knowledge_source_id');
    }
}
