<?php

namespace App\Http\Controllers;

use App\Models\Desarrollador;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class DesarrolladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desarrolladores = Desarrollador::all();
        return view('desarrolladores.index', compact('desarrolladores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyecto::orderBy('nombre', 'asc')
                                ->get();
        return view('desarrolladores.insert', compact('proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Desarrollador::create($request->all());
        return redirect()->route('desarrolladores.index')->with('exito', '¡El registro se ha creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desarrollador  $desarrollador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desarrollador = Desarrollador::join('proyectos', 'desarrolladors.proyecto_id', 'proyectos.id')
                                        ->select('desarrolladors.id', 'desarrolladors.nombre', 
                                        'desarrolladors.apellido', 'desarrolladors.telefono', 
                                        'desarrolladors.direccion', 'proyectos.nombre as proyecto')
                                        ->where('desarrolladors.id', $id)
                                        ->first();
        //
        return view('desarrolladores.show', compact('desarrollador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desarrollador  $desarrollador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desarrollador = Desarrollador::findOrFail($id);
        $proyectos = Proyecto::orderBy('nombre', 'asc')
                                ->get();
        
        //
        return view('desarrolladores.edit', compact('desarrollador', 'proyectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desarrollador  $desarrollador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $desarrollador = Desarrollador::findOrFail($id);
        $desarrollador->update($request->all());
        return redirect()->route('desarrolladores.index')->with('exito', '¡El registro se ha modificado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desarrollador  $desarrollador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desarrollador = Desarrollador::findOrFail($id);
        $desarrollador->delete();
        return redirect()->route('desarrolladores.index');
    }
}
