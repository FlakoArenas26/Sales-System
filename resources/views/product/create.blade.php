@extends('template')

@section('title', 'Nuevo Producto')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Nuevo Producto</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">Nuevo
                Producto</li>
        </ol>
        <div class="container w-100 border border-3 border-secondary rounded p-4 mt-3">
            <form action="{{ route('product.store') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ old('code') }}">
                            @error('code')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="code">Código</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="name">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="description">Descripción</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                value="{{ old('expiration_date') }}">
                            @error('expiration_date')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="expiration_date">Fecha Vencimiento</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" class="form-control" id="img_path" name="img_path"
                                value="{{ old('img_path') }}" accept="Image/*">
                            @error('img_path')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="img_path">Ruta Imagen</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" selectpicker id="brand_id" name="brand_id">
                                <option selected>Seleccionar ...</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->feature->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="brand_id">Marca</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="presentation_id" name="presentation_id">
                                <option selected>Seleccionar ...</option>
                                @foreach ($presentations as $presentation)
                                    <option value="{{ $presentation->id }}">{{ $presentation->feature->name }}</option>
                                @endforeach
                            </select>
                            @error('presentation_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="presentation_id">Presentación</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected>Seleccionar ...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->feature->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                            <label for="category_id">Categoría</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush
