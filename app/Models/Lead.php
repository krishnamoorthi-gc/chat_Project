<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatbot_id',
        'ip_address',
        'city',
        'region',
        'country',
        'visit_count',
        'last_visit_at',
        'user_agent',
    ];

    protected $casts = [
        'last_visit_at' => 'datetime',
    ];

    public function chatbot()
    {
        return $this->belongsTo(Chatbot::class);
    }
}
