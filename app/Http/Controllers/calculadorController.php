<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\calculovelocidad;

class calculadorController extends Controller
{
    

    public function calculo(Request $request)
    {
        //metros / minutos
        //v=d/t
        $respuesta= $request->distancia / $request->tiempo;
        $calculov = new calculovelocidad();
        //print_r("resultado de calculo "+ $respuesta); 
        $calculov->metros = $request->distancia;
        $calculov->minutos = $request->tiempo;
        $calculov->total = $respuesta;

        $calculov->save();
    }


    public function resultados()
    {
        $marcaje = calculovelocidad::orderBy('fecha','desc')->get();

        return $marcaje;
    }

}
