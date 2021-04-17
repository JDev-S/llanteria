@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Servicios</a></li>
            <li class="breadcrumb-item active">Agregar servicios</li>
        </ol>

    </div>

    <div class="page-content">




        <!-- Panel Inline Form -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">
                    Servicios
                </h3>
            </header>
            <div class="panel-body">
                <p>
                    LLena los campos para registrar un nueo servicio
                </p>
                <div class="example-wrap">

                    <div class="example">
                        <form class="form-inline" method="POST" action={{route('agregar_servicio')}}>
                    {{ csrf_field() }}



                    </div>



                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelUsername">Nombre del servicio</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del servicio" autocomplete="off" required>
                    </div>

                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" autocomplete="off" required>
                    </div>

                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Descripción</label>
                        <!--<input type="password" class="form-control" id="inputUnlabelPassword" placeholder="Password" autocomplete="off">-->
                        <textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripción"></textarea>
                    </div>

                    <div class="form-group form-material">
                        <button type="submit" class="btn btn-primary">Crear servicio</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Panel Inline Form -->

        <!-- Panel Controls Sizing -->

        <!-- End Panel Controls Sizing -->

        <!-- Panel Input Grid -->
        <!-- End Panel Input Grid -->
    </div>
</div>
<!-- End Page -->

@stop
