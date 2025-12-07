<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    // GET /api/NombreRecurso
    // Obtener Todos
    public function index()
    {
        $skill = Skill::orderByDesc('id')->get();

        $data = [
            'skill' => $skill,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    // GET /api/NombreRecurso/{id}
    // Obtener dato por id
    public function show($id)
    {
        $skill = Skill::find($id);

        // Método cuando no se encuentran datos
        if (!$skill) {
            $data = [
                'message' => 'Error al encontrar skill',
                'status' => 404,
            ];
            // Retornamos la data del error
            return response()->json($data, 404);
        }

        $data = [
            'skill' => $skill,
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
        $skill = Skill::create([
            'name' => $request->name
        ]);

        // Método por si falla la inserción de datos
        if (!$skill) {
            $data = [
                'message' => 'Error al crear skill',
                'status' => 500,
            ];
            // Retornamos la data del error
            return response()->json($data, 500);
        }

        // Método cuando se inserta correctamente
        $data = [
            'skill' => $skill,
            'status' => 201,
        ];

        // Retornamos datos del modelo creado
        return response()->json($data, 201);
    }


    // DELETE /api/NombreControlador/{id}
    // Eliminar Datos
    public function destroy($id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            $data = [
                'message' => 'No se encontró skill',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $skill->delete();

        $data = [
            'message' => 'skill eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    // PUT /api/NombreControlador/{id}
    // Actualizar todos los Datos
    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            $data = [
                'message' => 'No se encontró skill',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar Datos
        $validator = Validator::make($request->all(), [
            // Arreglo de datos a iterar
            'name' => 'required',
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
        $skill->name = $request->name;

        $skill->save();

        $data = [
            'message' => 'skill actualizado',
            'skill' => $skill,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

}
