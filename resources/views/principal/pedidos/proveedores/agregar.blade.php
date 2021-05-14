@extends('welcome')
@section('contenido')

<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Realizar un pedido a proveedor</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pedido a proveedor</a></li>

        </ol>

    </div>

    <div class="page-content">

        <div class="panel-body container-fluid">
            <div class="row ">

                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Nombre del producto</th>
                            <th>Nombre del proveedor</th>
                            <th>Nombre de la empresa</th>
                            <th>Nombre de la sucursal</th>
                            <th>Precio compra</th>
                            <th>Comprar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($catalogos as $catalogo)
                        <tr>
                            <td>{{$catalogo-> nombre}}</td>
                            <td>{{$catalogo-> nombre_contacto}}</td>
                            <td>{{$catalogo-> nombre_empresa}}</td>
                            <td>{{$catalogo-> sucursal}}</td>
                            <td>{{$catalogo-> precio_compra}}</td>
                           
                            <!--<td> <a href="javascript:enviar()">comprar</a></td>-->
                            <!--<td><input type="button" onclick="enviar_formulario()" value="Comprar"></td>-->
                            <td><a href="javascript:agregar_productos('{{$catalogo-> id_producto}}','{{$catalogo-> nombre}}','{{$catalogo-> precio_compra}}','{{$catalogo-> id_sucursal}}','{{$catalogo->id_catalogo}}');" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Comprar">Pedir</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="example table-responsive">
                    <p>Numero de articulos </p>
                    <p id="cantidad">0</p>
                    <table class="table" id="tabla_productos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="productos">

                        </tbody>
                    </table>
                </div>
                <div class="panel-body">
                    <p>
                        LLena los campos para generar la venta
                    </p>
                  
                            <input class="primary" type="button" name="enviar" value="Enviar" onclick="generar_venta();">


                    </div>
                </div>


            </div>
        </div>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
    var llenado = "";
    var productos = new Array();
    var total = 0;
    /*let p=[
        {
            "id_producto": 1,
            "cantidad_producto": 1,
            "precio_unidad": 1,
            "total": 1 * 1
        },
         {
            "id_producto": 2,
            "cantidad_producto": 1,
            "precio_unidad": 2,
            "total": 1 *2
        },
        {
            "id_producto": 3,
            "cantidad_producto": 1,
            "precio_unidad": 3,
            "total": 1 * 3
        }
    ];*/
    function agregar_productos(id_producto, nombre, precio, id_sucursal,catalogo) {
        var tableRef = document.getElementById('productos');
        // Inserta una fila en la tabla, en el índice 0
        var fila = document.getElementById("cantidad").innerHTML;
        var nueva_fila = parseInt(fila) + 1;
        document.getElementById("cantidad").innerHTML = nueva_fila;
        var bandera = 0;

        if (productos.length < 1) {
            alert("No hay se va a  ingresar");
            document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                '<td>' + id_producto + '</td>' +
                '<td>' + nombre + '</td>' +
                '<td>' + precio + '</td>' +
                '<td>' + id_sucursal + '</td>' +
                '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                '</tr>';
            total = total + parseInt(precio);
            var producto = {
                "id_producto": id_producto,
                "cantidad_producto": 1,
                "precio_unidad": precio,
                "total": 1 * parseInt(precio),
                "catalogo": catalogo
            };

            productos.push(producto);
        } else {
            for (var i = 0; i < productos.length; i++) {
                console.log(productos[i]);
                if (productos[i]['id_producto'] == id_producto) {
                    var cantidad = 0;
                    var total_producto = 0;
                    alert("es repetido");
                    cantidad = parseInt(productos[i]['cantidad_producto']) + 1;
                    total_producto = parseInt(productos[i]['precio_unidad']) * cantidad;
                    productos[i]['cantidad_producto'] = cantidad;
                    productos[i]['total'] = total_producto;
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
                    '<td>' + precio + '</td>' +
                    '<td>' + id_sucursal + '</td>' +
                    '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                    '</tr>';
            } else {
                document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                    '<td>' + id_producto + '</td>' +
                    '<td>' + nombre + '</td>' +
                    '<td>' + precio + '</td>' +
                    '<td>' + id_sucursal + '</td>' +
                    '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                    '</tr>';
                total = total + parseInt(precio);
                var producto = {
                    "id_producto": id_producto,
                    "cantidad_producto": 1,
                    "precio_unidad": precio,
                    "total": 1 * parseInt(precio),
                    "catalogo": catalogo
                };

                productos.push(producto);
            }

        }

    }

    function generar_venta() {
        id_cliente = "";
        factura = "";
        id_metodo_pago = "";
        alert("Generando venta");
        console.log(productos);
        //var cliente = document.getElementById('id_cliente');
        //var pago = document.getElementById('id_metodo_pago');
        

        var memo = document.getElementsByName('factura');
        for (i = 0; i < memo.length; i++) {
            if (memo[i].checked) {
                var memory = memo[i].value;
                factura = memory;
            }

        }
        var total_venta = 0;
        for (var t = 0; t < productos.length; t++) {
            total_venta += parseInt(productos[t]['total']);
        }

        var token = '{{csrf_token()}}';
        var data = {
            total_venta: total_venta,
            array_productos: productos,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/insertar_pedido_proveedor",
            data: data,
            success: function(msg) {
                alert(msg);
                locatin.href = "/mostrar_venta"
            }
        });
    }


    function borrar_formulario(row) {

        var d = row.parentNode.parentNode.rowIndex;
        alert(d);
        document.getElementById('tabla_productos').deleteRow(d);
    }

</script>

@stop
@stop
