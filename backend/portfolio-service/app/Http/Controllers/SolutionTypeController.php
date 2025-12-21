<?php

namespace App\Http\Controllers;

use App\Models\SolutionType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolutionTypeController extends Controller
{
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $solutionType = SolutionType::orderByDesc('id')->get();

        $data = [
            'solutionType' => $solutionType,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $solutionType = SolutionType::find($id);

        // Método cuando no se encuentran datos
        if (!$solutionType) {
            $data = [
                'message' => 'Error al encontrar solutionType',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'solutionType' => $solutionType,
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
            'slug' => 'required|unique:solution_types',
            'name' => 'required|string|unique:solution_types',
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

        // // Método para insertar datos después de validar
        // $solutionType = SolutionType::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $solutionType = SolutionType::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$solutionType) {
            $data = [
                'message' => 'Error al crear solutionType',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'solutionType' => $solutionType,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $solutionType = SolutionType::find($id);

        if (!$solutionType) {
            $data = [
                'message' => 'No se encontró solutionType',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $solutionType->delete();

        $data = [
            'message' => 'solutionType eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $solutionType = SolutionType::find($id);

        if (!$solutionType) {
            $data = [
                'message' => 'No se encontró solutionType',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'required|unique:solution_types',
            'name' => 'required|string|unique:solution_types',
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

        $solutionType->update($validator->validated());

        $data = [
            'message' => 'solutionType actualizado',
            'solutionType' => $solutionType,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $solutionType = SolutionType::find($id);

        if (!$solutionType) {
            $data = [
                'message' => 'No se encontró solutionType',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'unique:solution_types',
            'name' => 'string|unique:solution_types',
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

        $solutionType->update($validated);

        $data = [
            'message' => 'solutionType actualizado',
            'solutionType' => $solutionType,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
