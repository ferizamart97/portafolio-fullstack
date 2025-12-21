<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $project = Project::with([
            'solutionTypes',
            'workModes',
            'experiences',
        ])->orderByDesc('id')->get();

        $data = [
            'projects' => $project,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/projects/{id}
    // Obtener dato por id
    public function show($id)
    {
        $project = Project::with([
            'solutionTypes',
            'workModes',
            'experiences',
        ])->find($id);

        //Metodo cuando no se encuentran datos
        if(!$project){
            $data = [
                'message' => 'Error al encontrar proyecto',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
                'message' => $project,
                'status' => 201,
        ];


        return response()->json($data, 201);
    }

    // POST /api/nombreControlle/
    // Insertar Datos
    public function store(Request $request)
    {
        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required',
            'client_name' => 'required',
            'slug' => 'required|unique:projects',
            'main_image_path' => 'required',
            'short_description' => 'required',
            'repository_url' => 'required',
            'is_active' => 'required',
            'is_featured' => 'required',
            'work_mode_id' => 'required',
            'experience_id' => 'required',
            'solution_type_ids'   => 'required|array',
            'solution_type_ids.*' => 'integer|exists:solution_types,id',

        ]);
        // Metodo por si falla la validacion
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        $solutionTypeIds = $request->solution_type_ids;

        //Metodo para insertar datos despues de validar
        $project = Project::create([
            'name'  => $request->name,
            'client_name'  => $request->client_name,
            'slug'  => $request->slug,
            'main_image_path'  => $request->main_image_path,
            'short_description'  => $request->short_description,
            'repository_url'  => $request->repository_url,
            'is_active'  => $request->is_active,
            'is_featured'  => $request->is_featured,
            'work_mode_id'  => $request->work_mode_id,
            'experience_id'  => $request->experience_id,
        ]);

        //Metodo por si falla la insercion de datos
        if(!$project){
            $data = [
                'message' => 'Error al crear Proyecto',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // guarda en tabla pivote
        $project->solutionTypes()->sync($solutionTypeIds);

        // Metodo cuando se inserta correctamente
         $data = [
              'message' => 'Proyecto creado Correctamente',
              'project' => $project->load('solutionTypes'),
              'status' => 201,
         ];
             // Retornamos datos del modelo creado
              return response()->json($data, 201);
    }

    // DELETE /api/nombreController/
    //Elminar Datos
    public function destroy($id)
    {
        $project = Project::find($id);

        if(!$project){
            $data = [
                'message' => 'No se encontro proyecto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Limpia relaciones many-to-many
            $project->solutionTypes()->detach();

            // Borra el proyecto
            $project->delete();

        $data = [
            'message' => 'Proyecto Eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // PUT /api/nombreController/
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if(!$project){
            $data = [
                'message' => 'No se encontro proyecto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required',
            'client_name' => 'required',
            'slug' => ['sometimes','required', Rule::unique('projects', 'slug')->ignore($project->id)],
            'main_image_path' => 'required',
            'short_description' => 'required',
            'repository_url' => 'required',
            'is_active' => 'required',
            'is_featured' => 'required',
            'work_mode_id' => 'required',
            'experience_id' => 'required',

            // ✅ pivote
            'solution_type_ids'   => 'required|array',
            'solution_type_ids.*' => 'integer|exists:solution_types,id',
        ]);
        // Metodo por si falla la validacion
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        $validated = $validator->validated();

        $solutionTypeIds = $validated['solution_type_ids'];
        unset($validated['solution_type_ids']);

        $project->update($validated);

        // ✅ reemplaza los solution types del proyecto por los nuevos
        $project->solutionTypes()->sync($solutionTypeIds);


        $data = [
            'message' => 'Proyecto actualizado',
            'proyecto' => $project->fresh()->load('solutionTypes'),
            'status' => 200,
        ];

        return response()->json($data, 200);

    }

    // PATCH /api/nombreController/
    // Actualizar Datos
    public function updatePartial(Request $request, $id)
    {
        $project = Project::find($id);

        if(!$project){
            $data = [
                'message' => 'No se encontro proyecto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => ['sometimes','required','string','max:255'],
            'client_name' => ['sometimes','required','string','max:255'],
            'slug' => ['sometimes','required','string','max:255', Rule::unique('projects', 'slug')->ignore($project->id)],
            'main_image_path' => ['sometimes','required','string','max:255'],
            'short_description' => ['sometimes','required','string'],
            'repository_url' => ['sometimes','required','string','max:255'],
            'is_active' => ['sometimes','required','boolean'],
            'is_featured' => ['sometimes','required','boolean'],
            'work_mode_id' => ['sometimes','required','integer','exists:work_modes,id'],
            'experience_id' => ['sometimes','required','integer','exists:experiences,id'],

            // ✅ pivote (si lo mandas, lo actualiza)
            'solution_type_ids'   => ['sometimes','required','array'],
            'solution_type_ids.*' => ['integer','exists:solution_types,id'],
        ]);
        // Metodo por si falla la validacion
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        //Condicional parta agregar solo lo obtenido
        $validated = $validator->validated();

        if (empty($validated)) {
            return response()->json([
                'message' => 'No enviaste campos para actualizar',
                'status'  => 400,
            ], 400);
        }

        // ✅ si viene la relación, actualízala
        if (array_key_exists('solution_type_ids', $validated)) {
            $project->solutionTypes()->sync($validated['solution_type_ids']);
            unset($validated['solution_type_ids']);
        }

        // ✅ si quedaron campos normales, actualízalos
        if (!empty($validated)) {
            $project->update($validated);
        }

        $data = [
            'message' => 'Proyecto actualizado',
            'proyecto' => $project->fresh()->load('solutionTypes'),
            'status' => 200,
        ];

        //retornamos los datos uardamos y actualizamos
        return response()->json($data, 200);

    }
}
