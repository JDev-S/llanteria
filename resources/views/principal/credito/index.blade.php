@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Creditos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Créditos clientes</a></li>
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
                            <th>Folio del crédito</th>
                            <th>Nombre del usuario</th>
                            <th>Sucursal del usuario</th>
                            <th>Nombre del cliente</th>
                            <th>Status</th>
                            <th>Fecha ultimo día</th>
                            <th>Monto pagado</th>
                            <th>Total de venta</th>
                            <th>Abonar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach($creditos as $credito)
                        {
                        echo'<tr>
                            <td><button class="btn btn-primary" data-target="#modalDetalle_'.$credito-> id_venta.'" data-toggle="modal" type="button">'.$credito-> id_venta.'</button></td>
                            <td><button class="btn btn-primary" data-target="#modalAbono_'.$credito-> id_credito.'" data-toggle="modal" type="button">'.$credito-> id_venta.'</button></td>';
                            echo'<td>'.$credito->nombre_usuario.'</td>'.
                            '<td>'.$credito->sucursal_usuario.'</td>'.
                            '<td>'.$credito-> nombre_cliente.'</td>'.
                            '<td>'.$credito-> status_credito.'</td>'.
                            '<td>'.$credito-> fecha_ultimo_dia.'</td>'.
                            '<td>'.$credito-> monto.'</td>'.
                            '<td>'.$credito->total_venta.'</td>';
                            if($credito->monto==$credito->total_venta)
                            {
                               echo' <td>No abonar</td>';
                            }
                            else
                            {
                                echo'<td><button class="btn btn-primary" data-target="#modalAbonar_'.$credito-> id_credito.'" data-toggle="modal" type="button">Abonar</button></td>';
                            }
                            
                            
                       echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--MODAL DEL DETALLE VENTA-->
        <?php
        foreach($creditos as $credito)
        {
        echo'<div class="modal fade" id="modalDetalle_'.$credito-> id_venta.'" aria-hidden="true" aria-labelledby="modalDetalle_'.$credito-> id_venta.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Detalle de la venta</h4>
                    </div>
                    <div class="modal-body">';
                        echo'<table class="table">
                        <thead>
                        <th>Nombre del producto</th>
                        <th>Cantidad del producto</th>
                        <th>precio unidad</th>
                        <th>total</th>
                        </thead>
                        
                        <tbody>';
                        for($a=0;$a<count($detalles);$a++)
                        {
                            if($detalles[$a]->id_venta==$credito->id_venta)
                            {
                                 echo '<tr>
                                    <td>'.$detalles[$a]->nombre.'</td>
                                   <td>'.$detalles[$a]->cantidad_producto.'</td>
                                    <td>'.$detalles[$a]->precio_unidad.'</td>
                                    <td>'.$detalles[$a]->total.'</td>
                                   
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
        <!--FIN MODAL DETALLE VENTA-->


        <!--MODAL DEL DETALLE Abonos-->
        <?php
        foreach($creditos as $credito)
        {
        echo'<div class="modal fade" id="modalAbono_'.$credito-> id_credito.'" aria-hidden="true" aria-labelledby="modalAbono_'.$credito-> id_credito.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Abonos realizados</h4>
                    </div>
                    <div class="modal-body">';
                        echo'<table class="table">
                        <thead>
                        <th>Folio del abono</th>
                        <th>Folio de crédito</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Comentario</th>
                        </thead>
                        
                        <tbody>';
                        for($a=0;$a<count($abonos);$a++)
                        {
                            if($abonos[$a]->id_credito==$credito->id_credito)
                            {
                                 echo '<tr>
                                    <td>'.$abonos[$a]->id_abono_credito.'</td>
                                   <td>'.$abonos[$a]->id_credito.'</td>
                                    <td>'.$abonos[$a]->fecha.'</td>
                                    <td>'.$abonos[$a]->monto.'</td>
                                   <td>'.$abonos[$a]->comentario.'</td>
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
        <!--FIN MODAL DETALLE VENTA-->


        <!--MODAL REALIZAR ABONOS-->
        <?php
        foreach($creditos as $credito)
        {
        echo'<div class="modal fade" id="modalAbonar_'.$credito-> id_credito.'" aria-hidden="true" aria-labelledby="modalAbonar_'.$credito-> id_credito.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Realizar abono</h4>
                    </div>
                    <div class="modal-body">
                          <div class="row">
                            <div class="col-xl-4 form-group">
                            <input id="id_credito" name="id_credito" type="hidden" value="'.$credito->id_credito.'">
                            <input id="id_cliente" name="id_cliente" type="hidden" value="'.$credito->id_cliente.'">
                              <input type="text" class="form-control" name="monto" id="monto" placeholder="Monto a abonar">
                            </div>
                           
                            
                            <div class="col-xl-12 form-group">
                              <textarea class="form-control" rows="5" id="comentario" name="comentario" placeholder="Ingrese un comentario"></textarea>
                            </div>
                            <div class="col-md-12 float-right">
                              <button onclick="realizar_abono()" class="btn btn-primary" data-dismiss="modal" type="button">Abonar </button>
                            </div>
                          </div>
                        </div>
                </div>
            </div>
        </div>';
        }
        ?>
        <!--FIN MODAL REALIZAR ABONOS-->


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

<script type="text/javascript">
    function realizar_abono() {
        //alert("Hola"); 
        var monto = document.getElementById('monto').value;
        var id_credito = document.getElementById('id_credito').value;
        var id_cliente = document.getElementById('id_cliente').value;
        var comentario = document.getElementById('comentario').value;

        alert("Realizando pago");
        var token = '{{csrf_token()}}';
        var data = {
            monto: monto,
            id_credito: id_credito,
            id_cliente: id_cliente,
            comentario: comentario,
            _token: token
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/insertar_abono",
            data: data,
            success: function(msg) {

                alert(msg);
                location.href = "/mostrar_creditos";
            }
        });

    }

</script>
@stop
@stop
