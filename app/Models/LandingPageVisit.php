<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageVisit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'referrer',
        'page_url',
    ];
}
