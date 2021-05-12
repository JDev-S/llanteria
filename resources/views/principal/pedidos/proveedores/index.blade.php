@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Pedidos a proveedores</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Proveedores</a></li>
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
                            <th>Id_Pedido</th>
                            <th>Nombre completo</th>
                            <th>Sucursal del pedido</th>
                            <th>Descripción</th>
                            <th>Total de venta</th>
                            <th>Fecha realizado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pedidos_proveedores as $pedido)
                        <tr>
                            <td><button class="btn btn-primary" data-target="#modalLlanta_{{$pedido-> id_pedido}}" data-toggle="modal" type="button">{{$pedido-> id_pedido}}</button></td>
                            <td>{{$pedido-> nombre_completo}}</td>
                            <td>{{$pedido-> sucursal_pedido}}</td>
                            <td>{{$pedido-> descripcion}}</td>
                            <td>{{$pedido-> total_venta}}</td>
                            <td>{{$pedido-> fecha_venta}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--MODAL DE LLANTAS-->
        @foreach($pedidos_detalles as $detalle)
        <div class="modal fade" id="modalLlanta_{{$detalle-> id_pedido_proveedor}}" aria-hidden="true" aria-labelledby="modalLlanta_{{$detalle-> id_pedido_proveedor}}" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Detalle del pedido</h4>
                    </div>
                    <div class="modal-body">
                        <div class="example-grid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Nombre del usuario: {{$detalle->nombre_contacto}} </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Sucursal del usuario: {{$detalle-> sucursal_usuario}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Total: {{$detalle-> total}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Cantidad: {{$detalle-> cantidad}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Precio por unidad: {{$detalle->precio_unidad}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="example-col">Nombre del producto: {{$detalle->nombre}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="example-col">Nombre del proveedor: {{$detalle->nombre_contacto}}</div>
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
