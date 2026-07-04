<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'profile_id',
        'project_name',
        'description',
        'thumbnail',
        'project_url',
        'github_url',
        'tech_stack',
        'category',
    ];

    protected $casts = [
        'tech_stack' => 'array',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
