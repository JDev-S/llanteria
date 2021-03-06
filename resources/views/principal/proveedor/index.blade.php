@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Proveedores</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <!--<li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>-->
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
                            <th>Id_Proveeodr</th>
                            <th>Nombre de la empresa</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Nombre de contacto</th>
                            <th>Correo eléctronico</th>
                            <th>Sucursal</th>
                            

                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{$proveedor-> id_proveedor}}</td>
                            <td>{{$proveedor-> nombre_empresa}}</td>
                            <td>{{$proveedor-> telefono}}</td>
                             <td>{{$proveedor-> direccion}}</td>
                            <td>{{$proveedor-> nombre_contacto}}</td>
                            <td>{{$proveedor-> correo_electronico}}</td>
                            <td>{{$proveedor-> sucursal}}</td>
                            
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
