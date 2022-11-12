<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_usuario;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_usuario = Tipo_usuario::all();
        return $tipo_usuario;
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
        $tipo_usuario = new Tipo_usuario();
        $tipo_usuario->nombre_tipo= $request->nombre_tipo;

        $tipo_usuario->save();
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
    public function update(Request $request)
    {
        $tipo_usuario = Tipo_usuario::findOrFail($request->id);
        $tipo_usuario->nombre_tipo= $request->nombre_tipo;

        $tipo_usuario->save();
        return $tipo_usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_usuario $tipo_usuario
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Response $request
     */
    public function destroy(Request $request)
    {
        print ' <---------------------------> ';

        $datos = $request->id;

        print $datos;
        print ' <---------------------------> ';

        $tipo_usuario = Tipo_usuario::destroy($request->id);

        return $tipo_usuario;
    }
}
