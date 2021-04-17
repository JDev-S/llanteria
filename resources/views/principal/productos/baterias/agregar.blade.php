@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Bateria</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Producto</a></li>
            <li class="breadcrumb-item active">Bateria</li>
        </ol>

    </div>

    <div class="page-content">
        <form autocomplete="off" enctype="multipart/form-data" method="POST" action={{route('agregar_bateria')}}>
            {{ csrf_field() }}
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6">
                            <!-- Example Basic Form (Form grid) -->
                            <div class="example-wrap">
                                <h4 class="example-title">Llena los campos para registrar una bateria</h4>
                                <div class="example">
                                    <?php
               $query2 = "select * from marca ";
                $data2=DB::select($query2);      
              ?>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Nombre de la bateria</label>
                                        <input type="text" class="form-control" id="nombre_bateria" name="nombre_bateria" placeholder="Nombre de la bateria" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Marca</label>
                                        <select class="form-control" id="validationCustom22" required name="marca">

                                            @foreach($data2 as $item)
                                            <option value="{{ $item->id_marca }}"> {{ $item->marca }} </option>

                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Precio</label>
                                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="inputBasicEmail">Foto</label>
                                        <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                            <input type="text" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <span class="btn btn-success btn-file">
                                                    <i class="icon md-upload" aria-hidden="true"></i>
                                                    <input type="file" name="fotografia_miniatura" required>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <!--<div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Foto</label>
                                        <input type="file" class="form-control" id="fotografia_miniatura" name="fotografia_miniatura">
                                    </div>-->


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
                                        <label class="form-control-label" for="inputBasicPassword">Modelo</label>
                                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Voltaje</label>
                                        <input type="text" class="form-control" id="voltaje" name="voltaje" placeholder="Voltaje" autocomplete="off" required>
                                    </div>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Capacidad de arranque</label>
                                        <input type="text" class="form-control" id="capacidad_arranque" name="capacidad_arranque" placeholder="Capacidad de arranque" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Capacidad de arranque en frio</label>
                                        <input type="text" class="form-control" id="capacidad_arranque_frio" name="capacidad_arranque_frio" placeholder="Capacidad de arranque en frio" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Medidas</label>
                                        <input type="text" class="form-control" id="medidas" name="medidas" placeholder="Medidas" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Peso</label>
                                        <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso" autocomplete="off" required>
                                    </div>

                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Tamaño</label>
                                        <input type="text" class="form-control" id="tamanio" name="tamanio" placeholder="Tamaño" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <button type="submit" class="btn btn-primary">Agregar Bateria</button>
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
