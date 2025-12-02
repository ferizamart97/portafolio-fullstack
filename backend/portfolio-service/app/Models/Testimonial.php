<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable = [
        'name',
        'company_name',
        'position',
        'short_description',
        'main_image_path',
        'is_active',
    ];
}
