@extends('welcome')
@section('styles')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/multiselect/css/multi-select.css">
@stop
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Reporte de ventas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/mostrar_inventario">Inventario</a></li>

        </ol>

    </div>

    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid">


                <!-- Example Basic Form (Form grid) -->
                <div class="example-wrap">
                    <h4 class="example-title">Seleccione la fecha de inicio y final </h4>
                    <div class="example">

                        <div class="form-group form-material">
                            <label class="form-control-label" for="inputBasicEmail">Fecha de inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"  autocomplete="off" required>
                        </div>

                        <div class="form-group form-material">
                            <label class="form-control-label" for="inputBasicEmail">Fecha Final</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"  autocomplete="off" required>
                        </div>
                         <button type="submit" class="btn btn-primary" onclick="mostrar_ventas();">Visualizar ventas</button>

                        <table id="data-table-prueba" class="table w-100 thead-primary">
                            <thead>
                                <tr>
                                    <th>Nombre de la sucursal</th>
                                    <th>Ventas</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <!-- End Example Basic Form -->

            </div>

        </div>

    </div>
</div>
<!-- End Page -->
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="/multiselect/js/jquery.multi-select.js"></script>
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
<script type="text/javascript">
    var tabla;
    var llenado = "";
    var productos = new Array();
    var total = 0;

    function mostrar_ventas() {

        var fecha_inicio = document.getElementById("fecha_inicio").value;
        var fecha_fin = document.getElementById("fecha_fin").value;

        alert(fecha_inicio+"   "+fecha_fin);
        var arr = [];

        var token = '{{csrf_token()}}';
        var data = {
            fecha_inicio: fecha_inicio,
            fecha_fin: fecha_fin,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/mostrar_reportes_ventas",
            data: data,
            success: function(msg) {
                var datos = JSON.parse(msg);
                datos.forEach(objeto => {
                    var tmp = [];

                    tmp.push(
                        objeto.sucursal,
                        objeto.venta
                    );
                    arr.push(tmp);
                    console.log(arr);
                });
                tabla = $('#data-table-prueba').DataTable({
                    destroy: true,
                    data: arr,
                    columns: [{
                            tittle: "Nombre de la sucursal"
                        },
                        {
                            tittle: "Ventas"
                        },


                    ],
                });
            }
        });
    }

</script>
@stop
@stop
