@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Cliente</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Cliente</a></li>
            <!--<li class="breadcrumb-item active">Refacción</li>-->
        </ol>

    </div>

    <div class="page-content">
        <form autocomplete="off" enctype="multipart/form-data" method="POST" action={{route('agregar_cliente')}}>
            {{ csrf_field() }}
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6">
                            <!-- Example Basic Form (Form grid) -->
                            <div class="example-wrap">
                                <h4 class="example-title">Llena los campos para registrar un cliente</h4>
                                <div class="example">
                                    <?php
               $query2 = "select * from sucursal ";
                $data2=DB::select($query2);      
              ?>


                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Nombre completo del cliente</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo del cliente" autocomplete="off" required>
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
                                        <label class="form-control-label" for="inputBasicEmail">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" autocomplete="off" required>
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
                                        <label class="form-control-label" for="inputBasicEmail">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Coreeo electrónico" autocomplete="off" required>
                                    </div>


                                    <div class="form-group form-material">
                                        <label class="form-control-label">Cliente Habitual</label>
                                        <div>
                                            <div class="radio-custom radio-default radio-inline">
                                                <div class="radio-custom radio-default radio-inline">
                                                    <input type="radio" id="inputBasicMale" name="habitual" value="1">
                                                    <label for="inputBasicMale">Sí</label>
                                                </div>
                                                <div class="radio-custom radio-default radio-inline">
                                                    <input type="radio" id="inputBasicFemale" name="habitual"  value="0">
                                                    <label for="inputBasicFemale">No</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group form-material">
                                        <button type="submit" class="btn btn-primary">Agregar cliente</button>
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
