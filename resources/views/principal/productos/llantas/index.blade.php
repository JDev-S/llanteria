@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Productos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Llantas</a></li>
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
                            <th>Código de la llanta</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Sucursal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($aProducto_llantas as $llanta)
                        <tr>
                            <td><button class="btn btn-primary" data-target="#modalLlanta_{{$llanta-> id_productos_llantimax}}_{{$llanta-> sucursal}}" data-toggle="modal" type="button">{{$llanta-> id_productos_llantimax}}</button></td>
                            <td>{{$llanta-> nombre}}</td>
                            <td>{{$llanta-> categoria}}</td>
                            <td>{{$llanta-> marca}}</td>
                            <td>{{$llanta-> modelo}}</td>
                            <td>{{$llanta-> precio}}</td>
                            <td><img src="/img/{{$llanta->fotografia_miniatura}}" width="80px" height="80px" alt="{{$llanta-> nombre}}"></td>
                            <td>{{$llanta-> sucursal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--MODAL DE LLANTAS-->
        @foreach($aProducto_llantas as $llanta)
        <div class="modal fade" id="modalLlanta_{{$llanta-> id_productos_llantimax}}_{{$llanta-> sucursal}}" aria-hidden="true" aria-labelledby="modalLlanta_{{$llanta-> id_productos_llantimax}}_{{$llanta-> sucursal}}" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Información de la llanta</h4>
                    </div>
                    <div class="modal-body">
                        <div class="example-grid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col"><img src="/img/{{$llanta->fotografia_miniatura}}" width="80px" height="80px" alt="{{$llanta-> nombre}}"> </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Nombre de la llanta: {{$llanta-> nombre}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Marca: {{$llanta-> marca}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Modelo: {{$llanta-> modelo}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Medida de la llanta: {{$llanta->medida}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Capacidad de carga: {{$llanta->capacidad_carga}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Indice de velocidad: {{$llanta->indice_velocidad}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Número de rin: {{$llanta->numero_rin}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Sucursal: {{$llanta-> sucursal}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Precio: {{$llanta-> precio}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!--FIN MODAL LLANTAS-->

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
