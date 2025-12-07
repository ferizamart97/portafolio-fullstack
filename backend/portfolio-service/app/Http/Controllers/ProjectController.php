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
        $project = Project::orderByDesc('id')->get();

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
        $project = Project::findOrFail($id);

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
        // Metodo cuando se inserta correctamente
         $data = [
              'message' => 'Proyecto creado Correctamente',
              'project' => $project,
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

        //Si la validacion es correcta
        $project->name = $request->name;
        $project->client_name = $request->client_name;
        $project->slug = $request->slug;
        $project->main_image_path = $request->main_image_path;
        $project->short_description = $request->short_description;
        $project->repository_url = $request->repository_url;
        $project->is_active = $request->is_active;
        $project->is_featured = $request->is_featured;
        $project->work_mode_id = $request->work_mode_id;
        $project->experience_id = $request->experience_id;

        $project->save();

        $data = [
            'message' => 'Proyecto actualizado',
            'proyecto' => $project,
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
            'name' => '',
            'client_name' => '',
            'slug' => ['sometimes', Rule::unique('projects', 'slug')->ignore($project->id)],
            'main_image_path' => '',
            'short_description' => '',
            'repository_url' => '',
            'is_active' => '',
            'is_featured' => '',
            'work_mode_id' => '',
            'experience_id' => '',
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
        if($request -> has('name')){
            $project->name = $request->name;
        }

        if($request -> has('client_name')){
            $project->client_name = $request->client_name;
        }

        if($request -> has('slug')){
            $project->slug = $request->slug;
        }

        if($request -> has('main_image_path')){
            $project->main_image_path = $request->main_image_path;
        }

        if($request -> has('short_description')){
            $project->short_description = $request->short_description;
        }

        if($request -> has('repository_url')){
            $project->repository_url = $request->repository_url;
        }

        if($request -> has('is_active')){
            $project->is_active = $request->is_active;
        }

        if($request -> has('is_featured')){
            $project->is_featured = $request->is_featured;
        }

        if($request -> has('work_mode_id')){
            $project->work_mode_id = $request->work_mode_id;
        }

        if($request -> has('experience_id')){
            $project->experience_id = $request->experience_id;
        }

        //Guardamos y actualizamos los datos
        $project->save();

        $data = [
            'message' => 'Proyecto actualizado',
            'proyecto' => $project,
            'status' => 200,
        ];

        //retornamos los datos uardamos y actualizamos
        return response()->json($data, 200);

    }
}
