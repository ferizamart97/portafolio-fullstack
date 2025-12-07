<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CertificationController extends Controller
{
    //
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $certification = Certification::orderByDesc('id')->get();

        $data = [
            'certification' => $certification,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $certification = Certification::find($id);

        // Método cuando no se encuentran datos
        if (!$certification) {
            $data = [
                'message' => 'Error al encontrar Certification',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'Certification' => $certification,
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
            'name' => 'required|max:255',
            'short_description' => 'required|string',
            'name_institution' => 'nullable|string|max:255',
            'url_institution' => 'nullable|url|max:255',
            'slug' => 'required|string|max:255|unique:certifications',
            'main_image_path' => 'nullable|string|max:255',
            'date_certification' => 'required|date',
            'date_end_certification' => 'nullable|date|after_or_equal:date_certification',

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
        $certification = Certification::create([
            'name'=> $request->name,
            'short_description'=> $request->short_description,
            'name_institution'=> $request->name_institution,
            'url_institution'=> $request->url_institution,
            'slug'=> $request->slug,
            'main_image_path'=> $request->main_image_path,
            'date_certification'=> $request->date_certification,
            'date_end_certification'=> $request->date_end_certification,
        ]);

        // Método por si falla la inserción de datos
        if (!$certification) {
            $data = [
                'message' => 'Error al crear Certification',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'Certification' => $certification,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }

    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $certification = Certification::find($id);

        if (!$certification) {
            $data = [
                'message' => 'No se encontró Certification',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $certification->delete();

        $data = [
            'message' => 'Certification eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $certification = Certification::find($id);

        if (!$certification) {
            $data = [
                'message' => 'No se encontró Certification',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required|max:255',
            'short_description' => 'required|string',
            'name_institution' => 'required|string|max:255',
            'url_institution' => 'required|url|max:255',
            'slug' => ['sometimes','required', Rule::unique('certifications', 'slug')->ignore($certification->id)],
            'main_image_path' => 'required|string|max:255',
            'date_certification' => 'required|date',
            'date_end_certification' => 'required|date|after_or_equal:date_certification',
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

        // Si la validación es correcta
        $certification->name= $request->name;
        $certification->short_description= $request->short_description;
        $certification->name_institution= $request->name_institution;
        $certification->url_institution= $request->url_institution;
        $certification->slug= $request->slug;
        $certification->main_image_path= $request->main_image_path;
        $certification->date_certification= $request->date_certification;
        $certification->date_end_certification= $request->date_end_certification;

        $certification->save();

        $data = [
            'message' => 'Certification actualizado',
            'Certification' => $certification,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    // PATCH /api/NombreControlador/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $certification = Certification::find($id);

        if (!$certification) {
            $data = [
                'message' => 'No se encontró Certification',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'max:255',
            'short_description' => 'string',
            'name_institution' => 'string|max:255',
            'url_institution' => 'url|max:255',
            'slug' => ['sometimes', Rule::unique('certifications', 'slug')->ignore($certification->id)],
            'main_image_path' => 'string|max:255',
            'date_certification' => 'date',
            'date_end_certification' => 'date|after_or_equal:date_certification',
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

        // Condicional para agregar solo lo obtenido
        if ($request->has('name')) {
            $certification->name= $request->name;
        }
        if ($request->has('short_description')) {
            $certification->short_description= $request->short_description;
        }
        if ($request->has('name_institution')) {
            $certification->name_institution= $request->name_institution;
        }
        if ($request->has('url_institution')) {
            $certification->url_institution= $request->url_institution;
        }
        if ($request->has('slug')) {
            $certification->slug= $request->slug;
        }
        if ($request->has('main_image_path')) {
            $certification->main_image_path= $request->main_image_path;
        }
        if ($request->has('date_certification')) {
            $certification->date_certification= $request->date_certification;
        }
        if ($request->has('date_end_certification')) {
            $certification->date_end_certification= $request->date_end_certification;
        }
        // Guardamos y actualizamos los datos
        $certification->save();

        $data = [
            'message' => 'Certification actualizado',
            'Certification' => $certification,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
