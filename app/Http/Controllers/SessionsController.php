<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usuario;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;




class SessionsController extends Controller
{

    public function regisro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'id_usuario'=>'requiered', 
            'usuario' => 'requiered',
            'id_tipo_usuario' => 'requiered',
            'id_empleado' => 'requiereded',
            'contrasena' => 'requiered|string|min:6'
        ]);


        $user = new usuario();
        //$user->id_usuario=$request->id_usuario; 
        $user->usuario = $request->usuario;
        $user->id_tipo_usuario = $request->id_tipo_usuario;
        $user->id_empleado = $request->id_empleado;
        $user->contrasena = Hash::make($request->contrasena);
        $user->save();
        return response()->json(["mensaje" => "usuario registrado correctamente"], 201);
    }

    public function login(Request $request)
    {
        //print_r("sesion");
        //print_r($request->usuario ."\n");
        // print_r($request->contrasena."\n");
        $email = $request->usuario;
        $password = $request->pass;

        $validator = Validator::make($request->all(), [
            'usuario' => 'required|usuario',
            'contrasena' => 'required',
        ]);


        $user = usuario::where("usuario", $request->usuario)->first();

        if (isset($user)) {

            if (Hash::check($request->pass, $user->contrasena)) {
                //print_r("sesion iniciada correctamente");  
                $token = $user->createToken('auth_token')->plainTextToken;
                $credentials = request([$email, $password]);
                $tk22= auth()->attempt($credentials);
                //$tk1='ok';
                //$tk1=$this->respondWithToken($token);
                return response()->json(["mensaje" => "sesion iniciada correctamente", "access_token" => $token], 201);
                
                //return $this->respondWhithToken($token);
            } else {
                
                return response()->json(["mensaje" => "contraseña incorrecta", "error" => true], 200);
            }
        } else {
            print_r("sesion no iniciada ");
            return response()->json(["mensaje" => "usuario no existe", "error" => true], 200);
        }
    }


    public function perfil()
    {
        $aut = Auth::user();

        return $aut;
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        
        
        return response()->json(["status" => 1, "mensaje" => "se ha cerrado la sesion"]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
           
        ]);
    }
}
