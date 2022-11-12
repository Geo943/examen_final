<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamento = Departamento::all();
        return $departamento;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamento = new Departamento();
        $departamento->nombre_depto= $request->nombre_depto;
        $departamento->desc= $request->desc;

        $departamento->save();
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
        $departamento = Departamento::findOrFail($request->id);
        $departamento->nombre_depto= $request->nombre_depto;
        $departamento->desc= $request->desc;

        $departamento->save();
        return $departamento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Response $request
     */
    public function destroy(Request $request)
    {

        $departamento = Departamento::destroy($request->id);

        return $departamento;
    }
}
