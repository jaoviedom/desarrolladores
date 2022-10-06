@extends('layouts.main')

@section('titulo', 'Detalle de desarrollador')

@section('content')

    <div class="row my-3">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <table class="table table-bordered mt-3">
                <tbody>
                    <tr>
                        <td class="fw-bold">Nombre</td>
                        <td>{{ $desarrollador->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Apellido</td>
                        <td>{{ $desarrollador->apellido }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Teléfono</td>
                        <td>{{ $desarrollador->telefono }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Dirección</td>
                        <td>{{ $desarrollador->direccion }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Proyecto</td>
                        <td>{{ $desarrollador->proyecto }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('desarrolladores.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="col-sm-3"></div>
    </div>
    
@endsection