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
                            <th>Cambiar status del pedido</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach($pedidos_solicitados as $pedido)
                        {
                            $boton_status="";
                            if($pedido->id_status=="5" ||$pedido->id_status=="3" )
                            {
                                $boton_status="<td>No se puede cambiar status</td>";
                            }
                            else
                            {
                                $boton_status=' <td><button class="btn btn-primary" data-target="#modalHistorial_'.$pedido-> id_pedido.'" data-toggle="modal" type="button">CambiarStatus</button></td>';
                            }
                            echo'
                           <tr>
                                <td><button class="btn btn-primary" data-target="#modalLlanta_'.$pedido-> id_pedido.'" data-toggle="modal" type="button">'.$pedido-> id_pedido.'</button></td>
                                <td>'.$pedido-> nombre_usuario_destino.'</td>
                                <td>'.$pedido-> nombre_sucursal_usuario_destino.'</td>
                                <td>'.$pedido-> nombre_usuario_origen.'</td>
                                <td>'.$pedido-> nombre_sucursal_usuario_origen.'</td>
                                <td>'.$pedido-> status.'</td>'.$boton_status.'
                               
                            </tr>';  
                        }
                       
                        
                            ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--MODAL DE LOS PEDIDOS-->
        <?php
        foreach($pedidos_solicitados as $pedido)
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

        <!--MODAL CAMBIAR STATUS-->
        <?php
        
        $query3="select* from status where id_status!=1 and id_status!=4 and id_status!=5";
        $query4="select* from status where id_status!=1 and id_status!=2";
        $solicitados=DB::select($query3);
        $aceptados=DB::select($query4);
       
        foreach($pedidos_solicitados as $pedido)
        {
        echo'<div class="modal fade" id="modalHistorial_'.$pedido-> id_pedido.'" aria-hidden="true" aria-labelledby="modalHistorial_'.$pedido-> id_pedido.'" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Cambiar status del pedido</h4>
                    </div>
                    <div class="modal-body">
                          <div class="row">
                            <div class="col-xl-12 form-group">
                            <input id="id_pedido" name="id_pedido" type="hidden" value="'.$pedido->id_pedido.'">';
                           echo' <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Status del pedido</label>
                                    <select class="form-control" id="status" required name="status" >';
                            $cantidades_historial=DB::select('select * from historial_pedido where id_pedido="'.$pedido->id_pedido.'"');
                                    if(count($cantidades_historial)==1)
                                    {
                                       foreach($solicitados as $item)
                                        {
                                          echo '<option value="'.$item->id_status.'">'.$item->status.' </option>';
                                        }  
                                    }
                                    else
                                    {
                                        foreach($aceptados as $item)
                                        {
                                          echo '<option value="'.$item->id_status.'">'.$item->status.' </option>';
                                        }
                                    }
            
                                       

                                  echo'  </select>
                                </div>';

                            
                             echo' 
                           
                            
                            <div class="col-xl-12 form-group">
                              <textarea class="form-control" rows="5" id="comentario" name="comentario" placeholder="Ingrese un comentario"></textarea>
                            </div>
                            <div class="col-md-12 float-right">
                              <button onclick="cambiar_status()" class="btn btn-primary" data-dismiss="modal" type="button">Cambiar status </button>
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
    
    
    function cambiar_status() {
        //alert("Hola"); 
        
        var id_pedido = document.getElementById('id_pedido').value;
        var id_status = document.getElementById('status').value;
        var comentario = document.getElementById('comentario').value;
        
        if(comentario.length==0)
        {
            comentario="Sin comentarios";        
        }

        alert("Realizando pago");
        var token = '{{csrf_token()}}';
        var data = {
            id_pedido: id_pedido,
            id_status: id_status,
            comentario: comentario,
            _token: token
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/actualizar_status_pedido",
            data: data,
            success: function(msg) {

                alert(msg);
                location.href = "/mostrar_pedido_solicitado";
            }
        });

    }

</script>
@stop
@stop
