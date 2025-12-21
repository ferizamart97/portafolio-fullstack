<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    // GET /api/education
    // Obtener Todos
    public function index()
    {
        $education = Education::orderByDesc('id')->get();

        $data = [
            'education' => $education,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/education/{id}
    // Obtener dato por id
    public function show($id)
    {
        $education = Education::find($id);

        // Método cuando no se encuentran datos
        if (!$education) {
            $data = [
                'message' => 'Error al encontrar Education',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'Education' => $education,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // POST /api/education
    // Insertar Datos
    public function store(Request $request)
    {
        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar

            'institution_name'  => 'required|string|max:255',
            'degree_title'  => 'required|string|max:255',
            'field'  => 'required|max:255',
            'level'  => 'required|max:255',
            'start_date'  => 'required|date',
            'end_date'  => 'nullable|date|after_or_equal:start_date',
            'location'  => 'required|string|max:255',
            'short_description'  => 'required|string',
            'institution_url'  => 'nullable|url|max:255',
            'institution_logo_path'  => 'nullable|string|max:255',
            'social_links'   => 'required|array',
            'social_links.*' => 'nullable|url|max:255',
            'is_current'  => 'required|boolean',

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
        // $education = Education::create([
        //     'institution_name'       => $request->institution_name,
        //     'degree_title'           => $request->degree_title,
        //     'field'                  => $request->field,
        //     'level'                  => $request->level,
        //     'start_date'             => $request->start_date,
        //     'end_date'               => $request->end_date,
        //     'location'               => $request->location,
        //     'short_description'      => $request->short_description,
        //     'institution_url'        => $request->institution_url,
        //     'institution_logo_path'  => $request->institution_logo_path,
        //     'social_links'           => $request->social_links,
        //     'is_current'             => $request->is_current,
        // ]);

        // $education = Education::create($request->only([
        //     'institution_name',
        //     'degree_title',
        //     'field',
        //     'level',
        //     'start_date',
        //     'end_date',
        //     'location',
        //     'short_description',
        //     'institution_url',
        //     'institution_logo_path',
        //     'social_links',
        //     'is_current',
        // ]));

        $education = Education::create($validator->validated());

        // Método por si falla la inserción de datos
        if (!$education) {
            $data = [
                'message' => 'Error al crear Education',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'Education' => $education,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/education/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $education = Education::find($id);

        if (!$education) {
            $data = [
                'message' => 'No se encontró Education',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $education->delete();

        $data = [
            'message' => 'Education eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/education/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $education = Education::find($id);

        if (!$education) {
            $data = [
                'message' => 'No se encontró Education',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'institution_name'       => ['sometimes','required','string','max:255'],
            'degree_title'           => ['sometimes','required','string','max:255'],
            'field'                  => ['sometimes','required','string','max:255'],
            'level'                  => ['sometimes','required','string','max:255'],
            'start_date'             => ['sometimes','required','date'],
            'end_date'               => ['sometimes','nullable','date','after_or_equal:start_date','exclude_if:is_current,1'],
            'location'               => ['sometimes','required','string','max:255'],
            'short_description'      => ['sometimes','required','string'],
            'institution_url'        => ['sometimes','nullable','url','max:255'],
            'institution_logo_path'  => ['sometimes','nullable','string','max:255'],
            'social_links'           => ['sometimes','required','array'],
            'social_links.*'         => ['nullable','url','max:255'],
            'is_current'             => ['sometimes','required','boolean'],
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
        $education->update($validator->validated());

        $data = [
            'message' => 'Education actualizado',
            'Education' => $education,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    // PATCH /api/education/{id}
    // Actualizar Datos parcialmente
    public function updatePartial(Request $request, $id)
    {
        $education = Education::find($id);

        if (!$education) {
            $data = [
                'message' => 'No se encontró Education',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            // Arreglo de datos a iterar
            'institution_name'       => ['sometimes','required','string','max:255'],
            'degree_title'           => ['sometimes','required','string','max:255'],
            'field'                  => ['sometimes','required','string','max:255'],
            'level'                  => ['sometimes','required','string','max:255'],
            'start_date'             => ['sometimes','required','date'],
            'end_date'               => ['sometimes','nullable','date','exclude_if:is_current,1'],
            'location'               => ['sometimes','required','string','max:255'],
            'short_description'      => ['sometimes','required','string'],
            'institution_url'        => ['sometimes','nullable','url','max:255'],
            'institution_logo_path'  => ['sometimes','nullable','string','max:255'],
            'social_links'           => ['sometimes','required','array'],
            'social_links.*'         => ['nullable','url','max:255'],
            'is_current'             => ['sometimes','required','boolean'],
        ]);

        $validator->after(function ($validator) use ($request, $education) {
            $start = $request->input('start_date', optional($education->start_date)->format('Y-m-d'));
            $end   = $request->input('end_date');

            if ($end && $start && $end < $start) {
                $validator->errors()->add('end_date', 'La fecha de fin debe ser mayor o igual a start_date.');
            }
        });

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


        // Condicional para agregar solo lo obtenido
        // Si la validación es correcta
        $education->update($validated);

        $data = [
            'message' => 'Education actualizado',
            'Education' => $education,
            'status' => 200,
        ];

        // Retornamos los datos guardados y actualizados
        return response()->json($data, 200);
    }
}
