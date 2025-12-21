<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndutryController extends Controller
{
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $industry = Industry::orderByDesc('id')->get();

        $data = [
            'Industry' => $industry,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $industry = Industry::find($id);

        // Método cuando no se encuentran datos
        if (!$industry) {
            $data = [
                'message' => 'Error al encontrar Industry',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'Industry' => $industry,
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
            'slug' => 'required|unique:industries',
            'name' => 'required|string|unique:industries',
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
        // $industry = Industry::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $industry = Industry::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$industry) {
            $data = [
                'message' => 'Error al crear Industry',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'Industry' => $industry,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $industry = Industry::find($id);

        if (!$industry) {
            $data = [
                'message' => 'No se encontró Industry',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $industry->delete();

        $data = [
            'message' => 'Industry eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $industry = Industry::find($id);

        if (!$industry) {
            $data = [
                'message' => 'No se encontró Industry',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'required|unique:industries',
            'name' => 'required|string|unique:industries',
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

        $industry->update($validator->validated());

        $data = [
            'message' => 'Industry actualizado',
            'Industry' => $industry,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $industry = Industry::find($id);

        if (!$industry) {
            $data = [
                'message' => 'No se encontró Industry',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'slug' => 'unique:industries',
            'name' => 'string|unique:industries',
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

        $industry->update($validated);

        $data = [
            'message' => 'Industry actualizado',
            'Industry' => $industry,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
