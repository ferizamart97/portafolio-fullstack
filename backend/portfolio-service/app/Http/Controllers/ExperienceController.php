<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    //

    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $experiencie = Experience::orderByDesc('id')->get();

        $data = [
            'Experience' => $experiencie,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $experiencie = Experience::find($id);

        // Método cuando no se encuentran datos
        if (!$experiencie) {
            $data = [
                'message' => 'Error al encontrar Experience',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'Experience' => $experiencie,
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
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'employment_type' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|max:255',
            'short_description' => 'required|string|max:255',
            'company_url' => 'required|url|max:255',
            'company_logo_path' => 'required|max:255',
            'social_links'   => 'required|array',
            'social_links.*' => 'nullable|url|max:255',
            'is_current' => 'required|boolean',
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
        // $experiencie = Experience::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $experiencie = Experience::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$experiencie) {
            $data = [
                'message' => 'Error al crear Experience',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'Experience' => $experiencie,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $experiencie = Experience::find($id);

        if (!$experiencie) {
            $data = [
                'message' => 'No se encontró Experience',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $experiencie->delete();

        $data = [
            'message' => 'Experience eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $experiencie = Experience::find($id);

        if (!$experiencie) {
            $data = [
                'message' => 'No se encontró Experience',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'employment_type' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|max:255',
            'short_description' => 'required|string|max:255',
            'company_url' => 'required|url|max:255',
            'company_logo_path' => 'required|max:255',
            'social_links'   => 'required|array',
            'social_links.*' => 'nullable|url|max:255',
            'is_current' => 'required|boolean',
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

        $experiencie->update($validator->validated());

        $data = [
            'message' => 'Experience actualizado',
            'Experience' => $experiencie,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $experiencie = Experience::find($id);

        if (!$experiencie) {
            $data = [
                'message' => 'No se encontró Experience',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'company_name' => 'string|max:255',
            'position_title' => 'string|max:255',
            'employment_type' => 'string|max:255',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'location' => 'string|max:255',
            'short_description' => 'string|string|max:255',
            'company_url' => 'string|url|max:255',
            'company_logo_path' => 'string|max:255',
            'social_links'   => 'array',
            'social_links.*' => 'nullable|url|max:255',
            'is_current' => 'boolean',
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

        $experiencie->update($validated);

        $data = [
            'message' => 'Experience actualizado',
            'Experience' => $experiencie,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
