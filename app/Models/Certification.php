<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certification extends Model
{
    protected $table = 'certifications';

    protected $fillable = [
        'profile_id',
        'title',
        'sub_title',
        'issuer',
        'credential_url',
        'start_date',
        'end_date',
        'description',
        'skills',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'skills' => 'array',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
