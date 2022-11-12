<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcacion;
use App\Models\Empleado;
use App\Models\Respuesta;

class MarcacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcaje = Marcacion::orderBy('fecha','desc')->get();

        return $marcaje;
    }


    /**
     * Display a listing of the resource for id user.
     *
     * @return \Illuminate\Http\Response
     */
    public function marcajeUid($id_empleado)
    {
        print_r($id_empleado);
        $marcaje = Marcacion::where('id_empleado', $id_empleado)
                            ->orderBy('fecha','desc')
                            ->get();                          

        return $marcaje;
    }



    //*******join 
    public function marcajehistorial()
    {
        $marcaje = Marcacion::join('empleados','empleados.id',"=","marcacions.id_empleado" )
                            ->select('id_empleado','nombre','apellido','tipo','fecha','hora')
                            ->orderBy('fecha','desc')
                            ->get();   
                            //print_r($marcaje);                       

        return $marcaje;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = Empleado::where('id', $request->id_empleado)->first();

        $res = new Respuesta();
        if (is_null($empleado)) {
            
            $res->estado=false;
            //$res->desc=null;
            //$res->fecha=null;
            //$res->hora=null;
            $res->error="el codigo de empleado no existe";
            
        } else {

            $marcaje1 = $request->id_empleado;
           // buscar marcaje por id empleado y fehca******
            $marcaje = Marcacion::where('id_empleado', $marcaje1)
                                ->where('fecha',$request->fecha)
                                ->orderBy('id','desc')
                                ->first();
            $hora=date("H:i:s");
            $hoy = date("Y-m-d");

            if (is_null($marcaje)) {
               // print_r("\n el codigo no existe");
                    
                    $marcaje = new Marcacion();
                    $marcaje->id_empleado= $request->id_empleado;
                    $marcaje->tipo="Entrada";
                    $marcaje->fecha= $hoy;
                    $marcaje->hora= $hora;
                    $marcaje->save();

                        $res->estado=true;
                        $res->desc="Entrada";
                        $res->usuario=$empleado->nombre;
                        $res->fecha=$hoy;
                        $res->hora=$hora;
                        $res->error="";

            } else {

                if ($marcaje->fecha != $hoy) {
                    //crear un marcaje nuevo como entrada
                    print_r("\n no existe marcaje del dia");
                    $marcaje = new Marcacion();
                    $marcaje->id_empleado= $request->id_empleado;
                    $marcaje->tipo="Entrada";
                    $marcaje->fecha= $hoy;
                    $marcaje->hora= $hora;

                    $marcaje->save();

                        $res->estado=true;
                        $res->desc="Entrada";
                        $res->usuario=$empleado->nombre;
                        $res->fecha=$hoy;
                        $res->hora=$hora;
                        $res->error="";
                } else {
                    if ($marcaje->fecha == $hoy && $marcaje->tipo =="Salida"){

                        $marcaje = new Marcacion();
                        $marcaje->id_empleado= $request->id_empleado;
                        $marcaje->tipo="Entrada";
                        $marcaje->fecha= $hoy;
                        $marcaje->hora= $hora;
    
                        $marcaje->save();
    
                            $res->estado=true;
                            $res->desc="Entrada";
                            $res->usuario=$empleado->nombre;
                            $res->fecha=$hoy;
                            $res->hora=$hora;
                            $res->error="";
                        

                    }else{
                        //actualizar marcaje como salida update
                        
                        $marcaje = new Marcacion();
                        $marcaje->id_empleado= $request->id_empleado;
                        $marcaje->tipo="Salida";
                        $marcaje->fecha= $hoy;
                        $marcaje->hora= $hora;
                        $marcaje->save();

                            $res->estado=true;
                            $res->desc="Salida";
                            $res->usuario=$empleado->nombre;
                            $res->fecha=$hoy;
                            $res->hora=$hora;
                            $res->error="";

                    }
                            
                }
            }
        }

        return $res;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marcaje = Marcacion::findOrFail($request->id);
        $marcaje->id_empleado = $request->id_empleado;
        $marcaje->fecha = $request->fecha;
        $marcaje->hora = $request->hora;

        $marcaje->save();
        return $marcaje;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $marcaje = Marcacion::destroy($request->id);

        return $marcaje;
    }
}
