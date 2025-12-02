<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionType extends Model
{
    //

    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_solution_type');
    }

}
