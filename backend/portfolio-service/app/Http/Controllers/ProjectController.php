<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    //

    // public function index()
    // {
    //     return response()->json(['msg' => 'Projetcs Corriendo']);
    // }


    // GET /api/projects
    public function index()
    {
        $projects = Project::all();

        return response()->json($projects);
    }

    // GET /api/projects/{project}
    public function show(Project $project)
    {
        $project->load(['workMode', 'experience']);

        return response()->json($project);
    }

}
