<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Urls extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'url',
        'short_url',
        'user_id',
    ];
}
