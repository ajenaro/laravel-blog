@extends('admin.layout')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Inicio</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <h1>Dashboard</h1>

    <p>Has iniciado sesión con el usuario {{ auth()->user()->name }}</p>

@endsection
