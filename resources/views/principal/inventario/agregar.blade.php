@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inventario</a></li>
            <li class="breadcrumb-item active">Agregar Inventario</li>
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
                    LLena los campos para registrar un nuevo producto a inventario
                </p>
                <div class="example-wrap">

                    <div class="example">
                        <form class="form-inline" method="POST" action={{route('agregar_inventario')}}>
                            {{ csrf_field() }}
                    </div>
                    <?php
               $query2 = "select * from sucursal ";
                $data2=DB::select($query2);   
                        
                $query3 = "select * from productos_llantimax ";
                $data3=DB::select($query3);  
              ?>

                    <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                        <select class="form-control" id="validationCustom22" required name="sucursal">

                            @foreach($data2 as $item)
                            <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Producto</label>
                        <select class="form-control" id="validationCustom22" required name="producto">

                            @foreach($data3 as $item3)
                            <option value="{{ $item3->id_productos_llantimax }}"> {{ $item3->nombre }} </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" autocomplete="off" required>
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
