@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Productos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Baterias</a></li>
            <!--<li class="breadcrumb-item active"></li>-->
        </ol>

    </div>

    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <!--<h3 class="panel-title">Basic</h3>-->
            </header>
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Id_Producto</th>
                            <th>Nombre del producto</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Sucursal</th>
                            <th>Cantidad</th>

                        </tr>
                    </thead>
                   
                    <tbody>
                       @foreach($aProducto_baterias as $bateria)
                        <tr>
                            <td><button class="btn btn-primary" data-target="#modalBateria_{{$bateria-> id_productos_llantimax}}_{{$bateria-> sucursal}}" data-toggle="modal" type="button">{{$bateria-> id_productos_llantimax}}</button></td>
                            <td>{{$bateria-> nombre}}</td>
                            <td>{{$bateria-> categoria}}</td>
                            <td>{{$bateria-> marca}}</td>
                            <td>{{$bateria-> modelo}}</td>
                            <td>{{$bateria-> precio}}</td>
                            <td><img src="/img/{{$bateria->fotografia_miniatura}}" width="80px" height="80px" alt="{{$bateria-> nombre}}"></td>
                            <td>{{$bateria-> sucursal}}</td>
                            <td>{{$bateria-> cantidad}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
 <!--MODAL BATERIAS-->
        @foreach($aProducto_baterias as $bateria)
        <div class="modal fade" id="modalBateria_{{$bateria-> id_productos_llantimax}}_{{$bateria-> sucursal}}" aria-hidden="true" aria-labelledby="modalBateria_{{$bateria-> id_productos_llantimax}}_{{$bateria-> sucursal}}" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Información de la batería</h4>
                    </div>
                    <div class="modal-body">
                        <div class="example-grid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col"><img src="/img/{{$bateria->fotografia_miniatura}}" width="80px" height="80px" alt="{{$bateria-> nombre}}"> </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Nombre de la Bateria: {{$bateria-> nombre}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Marca: {{$bateria-> marca}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Modelo: {{$bateria-> modelo}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Medida de la bateria: {{$bateria->medidas}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Voltaje: {{$bateria->voltaje}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Capacidad de arranque: {{$bateria->capacidad_arranque}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Capacidad de arranque de frío: {{$bateria->capacidad_arranque_frio}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Peso: {{$bateria-> peso}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Tamaño: {{$bateria->tamanio}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Sucursal: {{$bateria-> sucursal}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Precio: {{$bateria-> precio}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!--FIN MODAL BATERIAS-->

    </div>
</div>
<!-- End Page -->
@section('scripts')
<!-- Plugins For This Page -->
<script src="\global\vendor\datatables.net\jquery.dataTables.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-bs4\dataTables.bootstrap4.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-fixedheader\dataTables.fixedHeader.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-fixedcolumns\dataTables.fixedColumns.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-rowgroup\dataTables.rowGroup.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-scroller\dataTables.scroller.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-responsive\dataTables.responsive.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-responsive-bs4\responsive.bootstrap4.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons\dataTables.buttons.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons\buttons.html5.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons\buttons.flash.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons\buttons.print.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons\buttons.colVis.min.js?v4.0.1"></script>
<script src="\global\vendor\datatables.net-buttons-bs4\buttons.bootstrap4.min.js?v4.0.1"></script>
<script src="\global\vendor\asrange\jquery-asRange.min.js?v4.0.1"></script>
<script src="\global\vendor\bootbox\bootbox.min.js?v4.0.1"></script>
@stop
@stop
