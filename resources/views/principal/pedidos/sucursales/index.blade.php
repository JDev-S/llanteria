@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Pedidos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Sucursales</a></li>
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
                            <th>Folio del pedido</th>
                            <th>Nombre del solicitante</th>
                            <th>Sucursal del solicitante</th>
                            <th>Nombre del distribuidor</th>
                            <th>Sucursal del distribuidor</th>
                            <th>Status pedido</th>
                            <th>Ver historial pedidos</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pedidos_sucursales as $pedido)
                        <tr>
                            <td><button class="btn btn-primary" data-target="#modalLlanta_{{$pedido-> id_pedido}}" data-toggle="modal" type="button">{{$pedido-> id_pedido}}</button></td>
                            <td>{{$pedido-> nombre_usuario_destino}}</td>
                            <td>{{$pedido-> nombre_sucursal_usuario_destino}}</td>
                            <td>{{$pedido-> nombre_usuario_origen}}</td>
                            <td>{{$pedido-> nombre_sucursal_usuario_origen}}</td>
                            <td>{{$pedido-> status}}</td>
                            <td><button class="btn btn-primary" data-target="#modalHistorial_{{$pedido-> id_pedido}}" data-toggle="modal" type="button">Ver mi historial</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--MODAL DE LOS PEDIDOS-->
        <?php
        foreach($pedidos_sucursales as $pedido)
        {
        echo'<div class="modal fade" id="modalLlanta_'.$pedido-> id_pedido.'" aria-hidden="true" aria-labelledby="modalLlanta_'.$pedido->id_pedido.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Detalle del pedido</h4>
                    </div>
                    <div class="modal-body">';
                        echo'<table class="table">
                        <thead>
                        <th>Folio del pedido</th>
                        <th>Id del productoNo</th>
                        <th>Nombre del producto</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        </thead>
                        
                        <tbody>';
                        for($a=0;$a<count($detalles_pedido_sucursal);$a++)
                        {
                            if($detalles_pedido_sucursal[$a]->id_pedido==$pedido->id_pedido)
                            {
                                 echo '<tr>
                                    <td>'.$detalles_pedido_sucursal[$a]->id_pedido.'</td>
                                   <td>'.$detalles_pedido_sucursal[$a]->id_producto.'</td>
                                    <td>'.$detalles_pedido_sucursal[$a]->nombre.'</td>
                                    <td>'.$detalles_pedido_sucursal[$a]->cantidad.'</td>
                                    <td>'.$detalles_pedido_sucursal[$a]->descripcion.'</td>
                                    </tr>';
                            }
                        }
                       
                    
                        echo'</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
        <!--FIN MODAL LLANTAS-->
        
        <!--MODAL DE HISTORIAL DEL PEDIDO-->
        <?php
        foreach($pedidos_sucursales as $pedido)
        {
        echo'<div class="modal fade" id="modalHistorial_'.$pedido-> id_pedido.'" aria-hidden="true" aria-labelledby="modalHistorial_'.$pedido->id_pedido.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Historial de mi pedido</h4>
                    </div>
                    <div class="modal-body">';
                        echo'<table class="table">
                        <thead>
                        <th>Folio del pedido</th>
                        <th>Status</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        </thead>
                        
                        <tbody>';
                        for($a=0;$a<count($historial_pedidos);$a++)
                        {
                            if($historial_pedidos[$a]->id_pedido==$pedido->id_pedido)
                            {
                                 echo '<tr>
                                    <td>'.$historial_pedidos[$a]->id_pedido.'</td>
                                   <td>'.$historial_pedidos[$a]->status.'</td>
                                    <td>'.$historial_pedidos[$a]->fecha_evento.'</td>
                                    <td>'.$historial_pedidos[$a]->descripcion_evento.'</td>
                                    </tr>';
                            }
                        }
                       
                    
                        echo'</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
        <!--FIN MODAL HISTORIAL-->
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
