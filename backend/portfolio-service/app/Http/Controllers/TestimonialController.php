<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $testimonial = Testimonial::orderByDesc('id')->get();

        $data = [
            'testimonial' => $testimonial,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $testimonial = Testimonial::find($id);

        // Método cuando no se encuentran datos
        if (!$testimonial) {
            $data = [
                'message' => 'Error al encontrar NombreModelo',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'NombreModelo' => $testimonial,
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
            // Arreglo de datos a iterar,
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'position' => 'required|max:255',
            'short_description' => 'required|max:255',
            'main_image_path' => 'required|max:255',
            'is_active' => 'required|boolean',
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
        // $testimonial = Testimonial::create([
        //     'NombreDato' => $request->NombreDato
        // ]);

        // Método 2 para insertar datos después de validar
        $testimonial = Testimonial::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$testimonial) {
            $data = [
                'message' => 'Error al crear testimonial',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'testimonial' => $testimonial,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            $data = [
                'message' => 'No se encontró NombreModelo',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $testimonial->delete();

        $data = [
            'message' => 'NombreModelo eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            $data = [
                'message' => 'No se encontró NombreModelo',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'position' => 'required|max:255',
            'short_description' => 'required|max:255',
            'main_image_path' => 'required|max:255',
            'is_active' => 'required|boolean',
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

        $testimonial->update($validator->validated());

        $data = [
            'message' => 'NombreModelo actualizado',
            'NombreModelo' => $testimonial,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            $data = [
                'message' => 'No se encontró NombreModelo',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'max:255',
            'company_name' => 'max:255',
            'position' => 'max:255',
            'short_description' => 'max:255',
            'main_image_path' => 'max:255',
            'is_active' => 'boolean',
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

        $testimonial->update($validated);

        $data = [
            'message' => 'NombreModelo actualizado',
            'NombreModelo' => $testimonial,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
