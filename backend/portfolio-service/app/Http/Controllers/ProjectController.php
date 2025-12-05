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
        $projects = Project::with([
            'workModes',
            'experiences',
        ])->orderByDesc('id')->get();

        return response()->json($projects);
    }


    // GET /api/projects/{id}
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return response()->json($project);
    }

}
