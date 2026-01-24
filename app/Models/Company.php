<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'bot_name',
        'welcome_message',
        'brand_color',
        'language',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function knowledgeSources()
    {
        return $this->hasMany(KnowledgeSource::class);
    }
}
