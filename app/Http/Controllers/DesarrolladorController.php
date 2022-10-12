<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Desarrollador;
use App\Models\Proyecto;
use Gate;

class DesarrolladorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
        if(Gate::denies('administrador'))
        {
            abort(403);
        }
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
        $datosDesarrollador = $request->except('_token');
        if($request->hasFile('foto'))
        {
            $datosDesarrollador['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Desarrollador::insert($datosDesarrollador);
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
        if(Gate::denies('administrador'))
        {
            abort(403);
        }
        $desarrollador = Desarrollador::join('proyectos', 'desarrolladors.proyecto_id', 'proyectos.id')
                                        ->select('desarrolladors.id', 'desarrolladors.nombre', 
                                        'desarrolladors.apellido', 'desarrolladors.telefono', 
                                        'desarrolladors.direccion', 'proyectos.nombre as proyecto',
                                        'desarrolladors.foto')
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
        if(Gate::denies('administrador'))
        {
            abort(403);
        }
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
        $datosDesarrollador = $request->except(['_token', '_method']);
        if($request->hasFile('foto'))
        {
            Storage::delete('public/' . $desarrollador->foto);
            $datosDesarrollador['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        
        Desarrollador::where('id', $id)->update($datosDesarrollador);
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
        if(Gate::denies('administrador'))
        {
            abort(403);
        }
        $desarrollador = Desarrollador::findOrFail($id);
        if(Storage::delete('public/' . $desarrollador->foto))
        {
            $desarrollador->delete();
        }
        return redirect()->route('desarrolladores.index');
    }
}
