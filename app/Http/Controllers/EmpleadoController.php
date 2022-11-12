<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado = Empleado::all();
        return $empleado;
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
        $empleado = new Empleado();
        $empleado->nombre= $request->nombre;
        $empleado->apellido= $request->apellido;
        $empleado->dpi= $request->dpi;
        $empleado->id_tipo_usuario= $request->id_tipo_usuario;
        $empleado->id_departamento= $request->id_departamento;
        $empleado->fecha_inicio_labores= $request->fecha_inicio_labores;
        $empleado->fecha_nacimiento= $request->fecha_nacimiento;


        $empleado->save();
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


    public function get($id){
        $empleado = Empleado::find($id);
        return response()->json($empleado, 200);
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
        $empleado = Empleado::findOrFail($request->id);
        $empleado->nombre= $request->nombre;
        $empleado->apellido= $request->apellido;
        $empleado->dpi= $request->dpi;
        $empleado->id_tipo_usuario= $request->id_tipo_usuario;
        $empleado->id_departamento= $request->id_departamento;
        $empleado->fecha_inicio_labores= $request->fecha_inicio_labores;
        $empleado->fecha_nacimiento= $request->fecha_nacimiento;

        $empleado->save();
        return $empleado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $empleado = Empleado::destroy($request->id);

        return $empleado;
    }
}
