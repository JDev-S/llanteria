@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Ventas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ventas realizadas</a></li>
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
                            <th>Folio de la venta</th>
                            <th>Vendedor</th>
                            <th>Sucursal</th>
                            <th>Cliente</th>
                            <th>Total de la venta</th>
                            <th>Método de pago</th>
                            <th>Fecha de la venta</th>
                            

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ventas as $venta)
                        <tr>
                            <td>{{$venta-> id_venta}}</td>
                            <td>{{$venta-> vendedor}}</td>
                            <td>{{$venta-> sucursal}}</td>
                            <td>{{$venta-> cliente}}</td>
                            <td>{{$venta-> total_venta}}</td>
                            <td>{{$venta-> metodo_pago}}</td>
                            <td>{{$venta-> fecha_venta}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Panel Basic -->

        <!-- Panel Table Individual column searching -->

        <!-- End Panel Table Individual column searching -->

        <!-- Panel Table Tools -->

        <!-- End Panel Table Tools -->

        <!-- Panel Table Add Row -->

        <!-- End Panel Table Add Row -->

        <!-- Panel FixedHeader -->

        <!-- End Panel FixedHeader -->

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
