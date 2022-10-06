@extends('layouts.main')

@section('titulo', 'Detalle de proyecto')

@section('content')

    <div class="row my-3">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <table class="table table-bordered mt-3">
                <tbody>
                    <tr>
                        <td class="fw-bold">Nombre</td>
                        <td>{{ $proyecto->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Duración</td>
                        <td>{{ $proyecto->duracion }} meses</td>
                    </tr>
                </tbody>
            </table>
            <h5 class="my-3">Desarrolladores:</h5>
            <ul class="list-group list-group-flush mb-3">
                @foreach ($desarrolladores as $item)
                    <li class="list-group-item">{{ $item->nombre }} {{ $item->apellido }}</li>
                @endforeach
            </ul>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="col-sm-3"></div>
    </div>
    
@endsection