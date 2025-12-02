<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //

    protected $fillable = [
        'company_name',
        'position_title',
        'employment_type',
        'start_date',
        'end_date',
        'location',
        'short_description',
        'company_url',
        'company_logo_path',
        'social_links',
        'is_current',
    ];

    protected $casts = [
        'social_links' => 'array',
        'start_date'   => 'date',
        'end_date'     => 'date',
        'is_current'   => 'boolean',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'experience_id');
    }
}
