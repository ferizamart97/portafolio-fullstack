<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    //Campos rellenables
    protected $fillable = [
        'name',
        'client_name',
        'slug',
        'main_image_path',
        'short_description',
        'repository_url',
        'is_active',
        'is_featured',
        'work_mode_id',
        'experience_id',
    ];

    //Relaciones pivot.
    //project_solution_type
    public function solutionTypes()
    {
        return $this->belongsToMany(SolutionType::class, 'project_solution_type');
    }

    //project_industry
    public function industries()
    {
        return $this->belongsToMany(Industry::class, 'project_industry');
    }

    //Relaciones tablas.
    public function workModes()
    {
        return $this->belongsTo(WorkMode::class, 'work_mode_id');
    }

    public function experiences()
    {
        return $this->belongsTo(Experience::class, 'experience_id');
    }



}


