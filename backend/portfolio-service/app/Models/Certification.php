<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    //
    protected $fillable = [
        'name',
        'short_description',
        'name_institution',
        'url_institution',
        'slug',
        'main_image_path',
        'date_certification',
        'date_end_certification',
    ];
}
