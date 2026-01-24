<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'prompt_template',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function knowledgeSources()
    {
        return $this->hasMany(KnowledgeSource::class);
    }
}
