@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar proveedor</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Proveedor</a></li>
            <!--<li class="breadcrumb-item active">Refacción</li>-->
        </ol>

    </div>

    <div class="page-content">
        <form autocomplete="off" enctype="multipart/form-data" method="POST" action={{route('agregar_proveedores')}}>
            {{ csrf_field() }}
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6">
                            <!-- Example Basic Form (Form grid) -->
                            <div class="example-wrap">
                                <h4 class="example-title">Llena los campos para registrar un proveedor</h4>
                                <div class="example">
                                    <?php
                                    $query2 = "select * from sucursal ";
                                    $data2=DB::select($query2);      
                                    ?>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Nombre de la empresa</label>
                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre de la empresa" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                                        <select class="form-control" id="sucursal" required name="sucursal">
                                            <option value="0">General</option>
                                            @foreach($data2 as $item)
                                            <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Teléfono</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" autocomplete="off" required>
                                    </div>


                                </div>
                            </div>
                            <!-- End Example Basic Form -->
                        </div>

                        <div class="col-md-6">
                            <!-- Example Basic Form (Form row) -->
                            <div class="example-wrap">
                                <!--<h4 class="example-title">Basic Form (Form row)</h4>-->
                                <div class="example">



                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" autocomplete="off" required>
                                    </div>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Nombre del contacto</label>
                                        <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" placeholder="Nombre del contacto" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Correo eléctronico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo eléctronico" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <button type="submit" class="btn btn-primary">Agregar proveedor</button>
                                    </div>

                                </div>
                            </div>
                            <!-- End Example Basic Form (Form row) -->
                        </div>


                    </div>
                </div>


            </div>
        </form>


        <!-- Panel Inline Form -->

        <!-- End Panel Inline Form -->

        <!-- Panel Controls Sizing -->

        <!-- End Panel Controls Sizing -->

        <!-- Panel Input Grid -->

        <!-- End Panel Input Grid -->
    </div>
</div>
<!-- End Page -->

@stop
