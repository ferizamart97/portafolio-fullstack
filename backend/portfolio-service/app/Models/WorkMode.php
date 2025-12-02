<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkMode extends Model
{
    //

    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'work_mode_id');
    }
}
