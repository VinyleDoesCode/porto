<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'photo',
        'full_name',
        'headline',
        'short_description',
        'email',
        'phone_number',
        'location',
        'linkedin',
        'github',
        'instagram',
    ];

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class)->orderBy('start_date', 'desc');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->orderBy('created_at', 'desc');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class)->orderBy('start_date', 'desc');
    }
}
