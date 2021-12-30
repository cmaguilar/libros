@extends('layouts.app')

@section('template_title')
    {{ $libro->name ?? 'Show Libro' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Vista del Libro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('libros.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {{ $libro->titulo }}
                        </div>
                        <div class="form-group">
                            <strong>Autor:</strong>
                            {{ $libro->autor }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $categorias[$libro->categoria_id] }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
