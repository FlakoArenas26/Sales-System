@extends('template')

@section('title', 'Categorías')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
@endpush

@section('content')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let message = "{{ session('success') }}";
                let type = 'success'; // Default to success

                // If there is an error session, change type to error
                if ("{{ session('error') }}") {
                    message = "{{ session('error') }}";
                    type = 'error';
                }

                if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        background: type === 'success' ? '#28a745' :
                        '#dc3545', // Green for success, red for error
                        iconColor: type === 'success' ? '#ffffff' : '#ffffff', // White icon color for both
                    });

                    Toast.fire({
                        icon: type,
                        title: message
                    })
                } else {
                    console.warn('SweetAlert2 is not loaded');
                    alert(message);
                }
            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Categorías</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item">Categorías</li>
        </ol>
        <div class="mb-4">
            <a href="{{ route('category.create') }}"><button class="btn btn-success" type="button">Crear</button></a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Categorías
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">
                                    {{ $category->feature->name }}
                                </td>
                                <td class="text-center">
                                    {{ $category->feature->description }}
                                </td>
                                <td class="text-center">
                                    @if ($category->feature->status == 1)
                                        <span class="fw-bolder rounded bg-success text-white p-1">Activo</span>
                                    @else
                                        <span class="fw-bolder rounded bg-danger text-white p-1">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="container text-center">
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('category.edit', ['category' => $category]) }}"
                                                method="GET">
                                                <button type="submit" class="btn btn-warning">
                                                    Editar
                                                </button>
                                            </form>
                                        </div>
                                        @if ($category->feature->status == 1)
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $category->id }}">
                                                    Eliminar
                                                </button>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $category->id }}">
                                                    Restaurar
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{ $category->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-center">
                                        <div class="modal-header text-center">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">
                                                {{ $category->feature->status == 1 ? 'Eliminar Categoría' : 'Restaurar Categoría' }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if ($category->feature->status == 1)
                                                ¿Estás seguro de que deseas eliminar la categoría
                                                <strong>{{ $category->feature->name }}</strong>?
                                            @else
                                                ¿Estás seguro de que quieres restaurar la categoría
                                                <strong>{{ $category->feature->name }}</strong>?
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <form
                                                action="{{ route('category.destroy', ['category' => $category->id]) }}"method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancelar</button>
                                                <button type="submit"
                                                    class="btn {{ $category->feature->status == 1 ? 'btn-danger' : 'btn-success' }}">
                                                    {{ $category->feature->status == 1 ? 'Eliminar' : 'Restaurar' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
@endpush
