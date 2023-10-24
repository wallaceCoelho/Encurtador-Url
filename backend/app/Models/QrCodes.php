<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCodes extends Model
{
    use HasFactory;

    public function url() : BelongsTo
    {
        return $this->belongsTo(Urls::class);
    }

    protected $fillable = [
        'dir_code',
        'user_id',
        'url_id',
    ];
}
