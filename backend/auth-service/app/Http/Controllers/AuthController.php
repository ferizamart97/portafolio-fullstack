<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    //FUNCION PAR LOGIN EN PANEL ADMIN
    public function login(Request $request): JsonResponse{

        $input = $request->all();
        //Revisamos que el email y password vengan con el formato correcto
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //Si falla la validacion con Validator::make
        if($validator->fails()){
            return $this->sendError('Error en la validacion', $validator->errors(), 422);
        }


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //Recuperamos el User()
            $user = Auth::user();
            //Generamos Token y lo guardamos en personal_access_tokens
            $success['token'] = $user->createToken('api_token')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Usuario Logueado Correctamente');
        }else{
            return $this->sendError('Algo Fallo Revisa tus credenciales', ['error'=>'Unauthorised'], 401);
        }
    }

    //FUNCION ME Optener datos usuario
    public function me(Request $request): JsonResponse{

        $user = $request->user();

        //Validacion Login
        if (!$user) {
            return $this->sendError('No autenticado', [], 401);
        }

        $data = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ];

        return $this->sendResponse($data, 'Usuario autenticado');
    }

    //Funcion de Logout
    public function logout(Request $request): JsonResponse{

        $user = $request->user();

        if (!$user || !$user->currentAccessToken()) {
            return $this->sendError('No hay sesión activa', [], 401);
        }

        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'Sesion cerrada correctamente');

    }

}
