<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'main_logo_path',
        'main_logo_secondary_path',
    ];


}
