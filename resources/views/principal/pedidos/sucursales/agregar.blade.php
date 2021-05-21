@extends('welcome')
@section('styles')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/multiselect/css/multi-select.css">
@stop
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Realizar pedido a sucursal</h1>
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
                    <h4 class="example-title">Seleccione una sucursal para hacer un pedido</h4>
                    <div class="example">
                        <?php
                        $id_sucursal_usuario_destino = session('id_sucursal_usuario');
                        $query2 = "SELECT * FROM sucursal where sucursal.id_sucursal!=".$id_sucursal_usuario_destino;
                        $data2=DB::select($query2);

                         ?>

                        <div class="form-group form-material">
                            <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                            <select class="form-control" id="sucursal" required name="sucursal" onChange="javascript:mostrar_productos_sucursal()">
                                <option value="a">Elige una sucursal</option>
                                @foreach($data2 as $item)
                                <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                                @endforeach

                            </select>
                        </div>

                        <table id="data-table-prueba" class="table w-100 thead-primary">
                            <thead>
                                <tr>
                                    <th>Id producto</th>
                                    <th>Nombre del producto</th>
                                    <th>Categoria</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Precio</th>
                                    <th>Foto</th>
                                    <th>Sucursal</th>
                                    <th>Cantidad</th>
                                    <th>Realizar pedido</th>


                                </tr>
                            </thead>

                        </table>

                        <div class="example table-responsive">
                            <p>Numero de articulos </p>
                            <p id="cantidad">0</p>
                            <table class="table" id="tabla_productos">
                                <thead>
                                    <tr>
                                        <th>Id_producto</th>
                                        <th>Nombre producto</th>
                                        <th>Sucursal</th>
                                        <th>Acción</th>

                                    </tr>
                                </thead>
                                <tbody id="productos">

                                </tbody>
                            </table>
                            <div id="mostrar_caracteristicas">

                            </div>
                        </div>
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

    function mostrar_productos_sucursal() {
        productos = [];
        document.getElementById("productos").innerHTML = "";
        document.getElementById("cantidad").innerHTML = 0;
        document.getElementById("mostrar_caracteristicas").innerHTML = "";
        alert(productos);
        var sucursal = document.getElementById("sucursal").value;
        console.log(document.getElementById("sucursal").value.type);
        alert(sucursal);
        var arr = [];

        var token = '{{csrf_token()}}';
        var data = {
            id_sucursal: sucursal,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/mostrar_productos_pedidos",
            data: data,
            success: function(msg) {
                var datos = JSON.parse(msg);
                datos.forEach(objeto => {
                    var tmp = [];
                    var producto = "";
                    var nombre = "";
                    var sucur = "";
                    var nombre_sucur = "";
                    var boton_pedir = "";
                    if (objeto.cantidad == "0") {
                        boton_pedir = "No hay producto";
                    } else {
                        producto = "'" + objeto.id_producto + "'";
                        nombre = "'" + objeto.nombre_producto + "'";
                        sucur = "'" + sucursal + "'";
                        nombre_sucur = "'" + objeto.sucursal + "'";
                        boton_pedir = '<td><a href="javascript:agregar_productos(' + producto + ',' + nombre + ',' + nombre_sucur + ',' + sucur + ');" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Pedir">Pedir</a></td>';
                    }


                    tmp.push(
                        objeto.id_producto,
                        objeto.nombre_producto,
                        objeto.categoria,
                        objeto.marca,
                        objeto.modelo,
                        objeto.precio,
                        "<img src='/img/" + objeto.foto + "' style='width:50px; height:30px;'>",
                        objeto.sucursal,
                        objeto.cantidad,
                        boton_pedir
                    );
                    arr.push(tmp);
                    console.log(arr);
                });
                tabla = $('#data-table-prueba').DataTable({
                    destroy: true,
                    data: arr,
                    columns: [{
                            tittle: "Id del producto"
                        },
                        {
                            tittle: "Nombre del producto"
                        },
                        {
                            tittle: "Categoria"
                        },
                        {
                            tittle: "Marca"
                        },
                        {
                            tittle: "Modelo"
                        },
                        {
                            tittle: "Precio"
                        },
                        {
                            tittle: "Foto"
                        },
                        {
                            tittle: "Sucursal"
                        },
                        {
                            tittle: "Cantidad"
                        },
                        {
                            tittle: "Pedir"
                        },

                    ],
                });
            }
        });
    }


    function agregar_productos(id_producto, nombre, nombre_sucursal, id_sucursal) {
        var tableRef = document.getElementById('productos');
        // Inserta una fila en la tabla, en el índice 0
        var fila = document.getElementById("cantidad").innerHTML;
        var nueva_fila = parseInt(fila) + 1;
        document.getElementById("cantidad").innerHTML = nueva_fila;
        var bandera = 0;
        var descripcion = "";

        if (productos.length < 1) {
            alert("No hay se va a  ingresar");
            document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                '<td>' + id_producto + '</td>' +
                '<td>' + nombre + '</td>' +
                '<td>' + nombre_sucursal + '</td>' +
                '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                '</tr>';
            descripcion = ' <div class="form-group form-material">' +
                '<label class="sr-only" for="inputUnlabelPassword">Descripción </label>' +

                '<textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripción general del pedido"></textarea>' +
                '</div>' +

                '<div class="form-group form-material">' +

                '<button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar servicio</button>' +
                '</div>';
            document.getElementById("mostrar_caracteristicas").innerHTML = descripcion;
            var producto = {
                "id_producto": id_producto,
                "cantidad_producto": 1,

                "id_sucursal_producto": id_sucursal
            };

            productos.push(producto);
        } else {
            for (var i = 0; i < productos.length; i++) {
                console.log(productos[i]);
                if (productos[i]['id_producto'] == id_producto) {
                    var cantidad = 0;

                    alert("es repetido");
                    cantidad = parseInt(productos[i]['cantidad_producto']) + 1;

                    productos[i]['cantidad_producto'] = cantidad;

                    bandera = 1;
                } else {
                    console.log("no hay repetido" + "ASI ESTA QUEDANDO LA INFO");
                    console.log(productos);

                }
            }
            if (bandera == 1) {
                document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                    '<td>' + id_producto + '</td>' +
                    '<td>' + nombre + '</td>' +
                    '<td>' + nombre_sucursal + '</td>' +
                    '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                    '</tr>';
            } else {
                document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                    '<td>' + id_producto + '</td>' +
                    '<td>' + nombre + '</td>' +
                    '<td>' + nombre_sucursal + '</td>' +
                    '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                    '</tr>';

                var producto = {
                    "id_producto": id_producto,
                    "cantidad_producto": 1,
                    "id_sucursal_producto": id_sucursal
                };

                productos.push(producto);
            }

        }

    }

    function enviar_datos() {
        //alert("Listo para enviar datos");
        alert("Generando venta");
        console.log(productos);
        var descripcion = document.getElementById('descripcion').value;
        var id_sucursal = document.getElementById('sucursal').value;
        console.log(descripcion);
        if (descripcion.length==0) {
            descripcion = "No hay especificacion en el pedido";
            console.log(descripcion);
        }
        var token = '{{csrf_token()}}';
        var data = {
            array_productos: productos,
            descripcion: descripcion,
            id_sucursal: id_sucursal,
            _token: token
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/insertar_pedido_sucursal",
            data: data,
            success: function(msg) {

                alert(msg);
                location.href = "/mostrar_pedido_sucursal";
            }
        });
    }

</script>
@stop
@stop
