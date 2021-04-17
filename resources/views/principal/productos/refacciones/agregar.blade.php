@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Refacción</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Producto</a></li>
            <li class="breadcrumb-item active">Refacción</li>
        </ol>

    </div>

    <div class="page-content">
        <form autocomplete="off" enctype="multipart/form-data" method="POST" action={{route('agregar_refaccion')}}>
            {{ csrf_field() }}
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6">
                            <!-- Example Basic Form (Form grid) -->
                            <div class="example-wrap">
                                <h4 class="example-title">Llena los campos para registrar un servicio</h4>
                                <div class="example">
                                    <?php
               $query2 = "select * from sucursal ";
                $data2=DB::select($query2);      
              ?>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Nombre de la refacción</label>
                                        <input type="text" class="form-control" id="nombre_refaccion" name="nombre_refaccion" placeholder="Nombre de la refacción" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                                        <select class="form-control" id="validationCustom22" required name="sucursal">

                                            @foreach($data2 as $item)
                                            <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

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
                                        <label class="form-control-label" for="inputBasicEmail">Marca</label>
                                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Modelo</label>
                                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="sr-only" for="inputUnlabelPassword">Descripción</label>
                                        <!--<input type="password" class="form-control" id="inputUnlabelPassword" placeholder="Password" autocomplete="off">-->
                                        <textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripción"></textarea>
                                    </div>

                                    <div class="form-group form-material">
                                        <button type="submit" class="btn btn-primary">Agregar refacción</button>
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