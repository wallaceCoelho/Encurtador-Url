<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'dir_code',
        'user_id',
        'url_id',
    ];
}
