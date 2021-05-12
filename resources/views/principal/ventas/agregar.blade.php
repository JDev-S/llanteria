@extends('welcome')
@section('contenido')

<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Form Layouts</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="..\index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
            <li class="breadcrumb-item active">Layouts</li>
        </ol>
        <div class="page-header-actions">
            <button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip" data-original-title="Edit">
                <i class="icon md-edit" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip" data-original-title="Refresh">
                <i class="icon md-refresh-alt" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip" data-original-title="Setting">
                <i class="icon md-settings" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">

        <div class="panel-body container-fluid">
            <div class="row ">

                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre del producto</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Disponible</th>
                            <th>Comprar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($inventarios as $inventario)
                        <tr>

                            <td><img src="/img/{{$inventario->foto}}" width="50px" height="50px" alt="{{$inventario-> nombre_producto}}"></td>
                            <td>{{$inventario-> nombre_producto}}</td>
                            <td>{{$inventario-> categoria}}</td>
                            <td>{{$inventario-> marca}}</td>
                            <td>{{$inventario-> modelo}}</td>
                            <td>{{$inventario-> precio}}</td>
                            <td>{{$inventario-> cantidad}}</td>
                            <!--<td> <a href="javascript:enviar()">comprar</a></td>-->
                            <!--<td><input type="button" onclick="enviar_formulario()" value="Comprar"></td>-->
                            <td><a href="javascript:agregar_productos('{{$inventario-> id_producto}}','{{$inventario-> nombre_producto}}','{{$inventario-> precio}}','{{$inventario-> id_sucursal}}');" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Comprar">Comprar</a></td>

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
                    <div class="example-wrap">

                        <div class="example">
                            <form class="form-inline">
                                {{ csrf_field() }}
                        </div>
                        <?php
                            $query2 = "select * from clientes ";
                            $data2=DB::select($query2); 
                            
                            $query3 = "select * from metodo_pago ";
                            $data3=DB::select($query3);
                        ?>
                        <div class="form-group form-material">
                            <label class="form-control-label" for="inputBasicPassword">Nombre del cliente</label>
                            <select class="form-control" id="id_cliente" required name="id_cliente">

                                @foreach($data2 as $item)
                                <option value="{{ $item->id_cliente }}"> {{ $item->nombre_completo }} </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group form-material">
                            <label class="form-control-label" for="inputBasicPassword">Tipo de pago</label>
                            <select class="form-control" id="id_metodo_pago" required name="id_metodo_pago">

                                @foreach($data3 as $item2)
                                <option value="{{ $item2->id_metodo_pago}}"> {{ $item2->metodo_pago}} </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group form-material">
                            <label class="form-control-label">Factura</label>
                            <div>
                                <div class="radio-custom radio-default radio-inline">
                                    <div class="radio-custom radio-default radio-inline">
                                        <input type="radio" id="factura" name="factura" value="1">
                                        <label for="inputBasicMale">Sí</label>
                                    </div>
                                    <div class="radio-custom radio-default radio-inline">
                                        <input type="radio" id="factura" name="factura" value="0">
                                        <label for="inputBasicFemale">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group form-material">
                            <input class="primary" type="button" name="enviar" value="Enviar" onclick="generar_venta();">
                        </div>
                        </form>

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
    function agregar_productos(id_producto, nombre, precio, id_sucursal) {
        var tableRef = document.getElementById('productos');
        // Inserta una fila en la tabla, en el índice 0
        var fila = document.getElementById("cantidad").innerHTML;
        var nueva_fila = parseInt(fila) + 1;
        document.getElementById("cantidad").innerHTML = nueva_fila;
        var bandera=0;

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
                "total": 1 * parseInt(precio)
            };

            productos.push(producto);
        } else {
            for (var i = 0; i < productos.length; i++) {
                console.log(productos[i]);
                if (productos[i]['id_producto'] == id_producto) {
                    var cantidad=0;
                    var total_producto=0;
                    alert("es repetido");
                     cantidad= parseInt(productos[i]['cantidad_producto'])+1;
                    total_producto=parseInt(productos[i]['precio_unidad'])*cantidad;
                    productos[i]['cantidad_producto']=cantidad;
                    productos[i]['total']=total_producto;
                    bandera=1;
                }
                else{
                    console.log("no hay repetido"+"ASI ESTA QUEDANDO LA INFO");
                    console.log(productos);
                    
                }
            }
            if(bandera==1)
               {
                   document.getElementById("productos").insertRow(fila).innerHTML = '<tr>' +
                        '<td>' + id_producto + '</td>' +
                        '<td>' + nombre + '</td>' +
                        '<td>' + precio + '</td>' +
                        '<td>' + id_sucursal + '</td>' +
                        '<td><input type="button" value="Delete" onclick="borrar_formulario(this)"/></td>' +
                        '</tr>';
               }
            else{
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
                        "total": 1 * parseInt(precio)
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
        var cliente = document.getElementById('id_cliente');
        var pago = document.getElementById('id_metodo_pago');
        id_cliente = cliente.value;
        id_metodo_pago = pago.value;

        var memo = document.getElementsByName('factura');
        for (i = 0; i < memo.length; i++) {
            if (memo[i].checked) {
                var memory = memo[i].value;
                factura = memory;
            }

        }
        var total_venta=0;
        for(var t=0;t<productos.length;t++)
            {
                total_venta+=parseInt(productos[t]['total']);
            }

        var token = '{{csrf_token()}}';
        var data = {
            id_cliente: id_cliente,
            id_metodo_pago: id_metodo_pago,
            total_venta: total_venta,
            factura: factura,
            array_productos: productos,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/insertar_venta",
            data: data,
            success: function(msg) {
                alert(msg);
                locatin.href="/mostrar_venta"
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
