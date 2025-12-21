<?php

namespace App\Http\Controllers;

use App\Models\WorkMode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkModeController extends Controller
{
    //

    // GET /api/WorkMode
    // Obtener Todos
    public function index()
    {
        $workMode = WorkMode::orderByDesc('id')->get();

        $data = [
            'WorkMode' => $workMode,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // GET /api/WorkMode/{id}
    // Obtener dato por id
    public function show($id)
    {
        $workMode = WorkMode::find($id);

        // Método cuando no se encuentran datos
        if (!$workMode) {
            $data = [
                'message' => 'Error al encontrar WorkMode',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'WorkMode' => $workMode,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // POST /api/NombreControlador
    // Insertar Datos
    public function store(Request $request)
    {
        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'required|unique:work_modes',
            'name' => 'required|string|unique:work_modes',
            'description' => 'required|string',
        ]);

        // Método por si falla la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        // Método para insertar datos después de validar
        // $workMode = WorkMode::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $workMode = WorkMode::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$workMode) {
            $data = [
                'message' => 'Error al crear WorkMode',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'WorkMode' => $workMode,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $workMode = WorkMode::find($id);

        if (!$workMode) {
            $data = [
                'message' => 'No se encontró WorkMode',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $workMode->delete();

        $data = [
            'message' => 'WorkMode eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $workMode = WorkMode::find($id);

        if (!$workMode) {
            $data = [
                'message' => 'No se encontró WorkMode',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'required|unique:work_modes',
            'name' => 'required|string|unique:work_modes',
            'description' => 'required|string',
        ]);

        // Método por si falla la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        $workMode->update($validator->validated());

        $data = [
            'message' => 'WorkMode actualizado',
            'WorkMode' => $workMode,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $workMode = WorkMode::find($id);

        if (!$workMode) {
            $data = [
                'message' => 'No se encontró WorkMode',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'unique:work_modes',
            'name' => 'string|unique:work_modes',
            'description' => 'string',
        ]);

        // Método por si falla la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            // Retornamos la data del error
            return response()->json($data, 400);
        }

        $validated = $validator->validated();
        if (empty($validated)) {
            return response()->json([
                'message' => 'No enviaste campos para actualizar',
                'status'  => 400,
            ], 400);
        }

        $workMode->update($validated);

        $data = [
            'message' => 'WorkMode actualizado',
            'WorkMode' => $workMode,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
