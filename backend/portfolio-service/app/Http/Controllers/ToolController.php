<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    //
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $tool = Tool::orderByDesc('id')->get();

        $data = [
            'NombreColeccion' => $tool,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $tool = Tool::find($id);

        // Método cuando no se encuentran datos
        if (!$tool) {
            $data = [
                'message' => 'Error al encontrar Tool',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'Tool' => $tool,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // POST /api/Tool
    // Insertar Datos
    public function store(Request $request)
    {
        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'main_logo_path' => 'required|string|max:255',
            'main_logo_secondary_path' => 'required|string|max:255'
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

        // // Método para insertar datos después de validar
        // $tool = Tool::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $tool = Tool::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$tool) {
            $data = [
                'message' => 'Error al crear Tool',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'Tool' => $tool,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/Tool/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $tool = Tool::find($id);

        if (!$tool) {
            $data = [
                'message' => 'No se encontró Tool',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $tool->delete();

        $data = [
            'message' => 'Tool eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/Tool/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $tool = Tool::find($id);

        if (!$tool) {
            $data = [
                'message' => 'No se encontró Tool',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'main_logo_path' => 'required|string|max:255',
            'main_logo_secondary_path' => 'required|string|max:255'
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

        $tool->update($validator->validated());

        $data = [
            'message' => 'Tool actualizado',
            'Tool' => $tool,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/Tool/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $tool = Tool::find($id);

        if (!$tool) {
            $data = [
                'message' => 'No se encontró Tool',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'string|max:255',
            'type' => 'string|max:255',
            'main_logo_path' => 'string|max:255',
            'main_logo_secondary_path' => 'string|max:255'
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

        $tool->update($validated);

        $data = [
            'message' => 'Tool actualizado',
            'Tool' => $tool,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
