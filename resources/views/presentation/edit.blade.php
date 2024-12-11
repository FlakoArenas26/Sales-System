@extends('template')

@section('title', 'Editar Presentación')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Presentación</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('presentation.index') }}">Presentacións</a></li>
            <li class="breadcrumb-item active">Editar Presentación</li>
        </ol>
        <div class="container w-100 border border-3 border-secondary rounded p-4 mt-3">
            <form action="{{ route('presentation.update', ['presentation' => $presentation]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $presentation->feature->name) }}">
                            @error('name')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="name">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="description">{{ old('description', $presentation->feature->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="description">Descripción</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
@endpush
