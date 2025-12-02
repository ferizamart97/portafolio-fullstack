<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //

    protected $fillable = [
        'institution_name',
        'degree_title',
        'field',
        'level',
        'start_date',
        'end_date',
        'location',
        'short_description',
        'institution_url',
        'institution_logo_path',
        'social_links',
        'is_current',
    ];

    protected $casts = [
        'social_links' => 'array',
        'start_date'   => 'date',
        'end_date'     => 'date',
        'is_current'   => 'boolean',
    ];


}
