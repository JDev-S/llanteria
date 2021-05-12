@extends('welcome')
@section('styles')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/multiselect/css/multi-select.css">
@stop
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Producto al proveedor</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/mostrar_proveedores">Proveedor</a></li>
            <li class="breadcrumb-item active">Produtos a proveedor</li>
        </ol>

    </div>

    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    <div class="col-md-6">
                        <!-- Example Basic Form (Form grid) -->
                        <div class="example-wrap">
                            <h4 class="example-title">Llena los campos para registrar un producto al proveedor</h4>
                            <div class="example">
                                <?php
                                    $query2 = "select * from sucursal ";
                                    $data2=DB::select($query2);

                                    ?>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                                    <select class="form-control" id="sucursal" required name="sucursal" onChange="javascript:uso_sucursal()">
                                        <option value="a">Elige una sucursal</option>
                                        <option value="0">General</option>
                                        @foreach($data2 as $item)
                                        <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group form-material" id="mostrar_categorias">
                                    <label class="form-control-label" for="inputBasicEmail">Categoria del producto</label>


                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Producto</label>
                                    <select class="form-control" id='productos' name="productos" multiple='multiple'>

                                    </select>
                                </div>


                            </div>
                        </div>
                        <!-- End Example Basic Form -->
                    </div>

                    <div class="col-md-6">
                        <!-- Example Basic Form (Form row) -->
                        <div class="example-wrap">
                            <!--<h4 class="example-title">Basic Form (Form row)</h4>-->
                            <div class="example">

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Proveedor</label>
                                    <select class="form-control" id="mostrar_proveedores" required name="proveedor">

                                    </select>
                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Proveedor</label>
                                    <select class="form-control" id="mostrar_proveedores" required name="proveedor">

                                    </select>
                                </div>
                                
                                <div class="form-group form-material">
                                    <button type="submit" class="btn btn-primary" onclick="mostrar_precios();">Agregar precios</button>
                                </div>

                                <div class="form-group form-material">
                                    <button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar catalogo</button>
                                </div>

                            </div>
                        </div>
                        <!-- End Example Basic Form (Form row) -->
                    </div>


                </div>
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
<script type="text/javascript">
    var id_sucursal = "";
    var nombre_categoria = "";
    let seleccionados = [];
    let deseleccionados = [];

    function uso_sucursal() {


        var sucursal = document.getElementById("sucursal").value;
        console.log(document.getElementById("sucursal").value.type);
        document.getElementById('mostrar_categorias').innerHTML = '';
        console.log("Valor de la sucursal : " + sucursal + "   tipo es :" + sucursal.type);
        if (sucursal == "a") {
            console.log("No se ingreso sucursal");
        } else {
            document.getElementById('productos').innerHTML = '';
            /*Limpiar productos en el multiselect*/
            $('#productos').multiSelect('destroy');
            seleccionados = [];
            deseleccionados = [];
            /*Fin limpiar multiselect*/
            id_sucursal = "";
            console.log("Se ingreso una sucuresal");
            if (sucursal != 0) {

                console.log("No se eligio general");
                document.getElementById('mostrar_categorias').innerHTML = "";
                var categorias2 = '<select class="form-control" id="categoria" required name="categoria">' +
                    '<option value="Refacción">Refaccion</option>' +
                    '</select>';
                document.getElementById('mostrar_categorias').innerHTML = categorias2;
            } else {
                console.log("Es una sucursal general");
                document.getElementById('mostrar_categorias').innerHTML = "";
                var categorias = '<select class="form-control" id="categoria" required name="categoria" onChange="javascript:uso_categoria()">' +
                    '<option value="elige">Elige una categoria </option>' +
                    '<option value="Llantas">Llantas</option>' +
                    '<option value="Bateria">Bateria</option>' +
                    '</select>';
                document.getElementById('mostrar_categorias').innerHTML = categorias;

            }
            var categoria = document.getElementById("categoria").value;
            console.log("Imprimir valor del la categoria " + categoria);
            document.getElementById('productos').innerHTML = '';
            document.getElementById('mostrar_proveedores').innerHTML = '';
            nombre_categoria = categoria;
            console.log("Muestro la categoria :" + categoria);
            console.log("Muestro el id_sucursal en ajax :" + id_sucursal);

            var token = '{{csrf_token()}}';
            var data = {
                sucursal: sucursal,
                _token: token
            };

            $.ajax({
                type: "POST",
                url: "/mostrar_productos_catalogo",
                data: data,
                success: function(msg) {
                    console.log(msg);

                    //var datos=JSON.parse(msg);
                    //console.log(datos);
                    var productos = "";
                    var proovedores = "";
                    document.getElementById('mostrar_proveedores').innerHTML = '';
                    console.log(msg.length);

                    for (j = 0; j < msg[0].length; j++) {
                        if (categoria != "elige") {
                            if (categoria == msg[0][j]['categoria']) {
                                productos += '<option value="' + msg[0][j]['id_productos_llantimax'] + '">' + msg[0][j]['categoria'] + ' ' + msg[0][j]['nombre'] + ' ' + msg[0][j]['marca'] + ' ' + msg[0][j]['modelo'] + '</option>';
                            }
                        }

                    }

                    /*Obtener los proveedores*/
                    for (k = 0; k < msg[1].length; k++) {
                        proovedores += '<option value="' + msg[1][k]['id_proveedor'] + '">' + msg[1][k]['nombre_empresa'] + ' ' + msg[1][k]['nombre_contacto'] + '</option>';
                    }

                    document.getElementById('productos').innerHTML = productos;
                    /*MOSTRAR PRODUCTOS EN LA LISTA*/
                    $('#productos').multiSelect({
                        afterSelect: function(values) {
                            alert("Select value: " + values);
                            seleccionados.push(values);
                        },
                        afterDeselect: function(values) {
                            alert("Deselect value: " + values);
                            deseleccionados.push(values);
                        }
                    });
                    /*FIN MOSTRAR PRODUCTOS*/
                    document.getElementById('mostrar_proveedores').innerHTML = proovedores;
                    console.log("MOSTRAR LOS PRODUCTOS");
                    console.log(productos);

                }
            });
        }
    }

    public

    function uso_categoria() {
        alert("ENTRO AL SEGUNDO METODO");
        var sucursal = document.getElementById("sucursal").value;
        var categoria = document.getElementById("categoria").value;
        if (categoria == "elige") {
            console.log("Ingrese una categoria");
        } else {
            document.getElementById('productos').innerHTML = '';
            /*Limpiar productos en el multiselect*/
            $('#productos').multiSelect('destroy');
            seleccionados = [];
            deseleccionados = [];
            /*Fin limpiar multiselect*/
            console.log("Imprimir valor del la categoria " + categoria);
            document.getElementById('productos').innerHTML = '';
            document.getElementById('mostrar_proveedores').innerHTML = '';
            nombre_categoria = categoria;
            console.log("Muestro la categoria :" + categoria);
            console.log("Muestro el id_sucursal en ajax :" + id_sucursal);

            var token = '{{csrf_token()}}';
            var data = {
                sucursal: sucursal,
                _token: token
            };

            $.ajax({
                type: "POST",
                url: "/mostrar_productos_catalogo",
                data: data,
                success: function(msg) {
                    console.log(msg);

                    //var datos=JSON.parse(msg);
                    //console.log(datos);
                    var productos = "";
                    var proovedores = "";
                    document.getElementById('mostrar_proveedores').innerHTML = '';
                    console.log(msg.length);

                    for (j = 0; j < msg[0].length; j++) {
                        console.log(categoria + "   " + msg[0][j]['categoria']);


                        if (categoria == msg[0][j]['categoria']) {
                            productos += '<option value="' + msg[0][j]['id_productos_llantimax'] + '">' + msg[0][j]['categoria'] + ' ' + msg[0][j]['nombre'] + ' ' + msg[0][j]['marca'] + ' ' + msg[0][j]['modelo'] + '</option>';
                        }


                    }

                    /*Obtener los proveedores*/
                    for (k = 0; k < msg[1].length; k++) {
                        proovedores += '<option value="' + msg[1][k]['id_proveedor'] + '">' + msg[1][k]['nombre_empresa'] + ' ' + msg[1][k]['nombre_contacto'] + '</option>';
                    }

                    document.getElementById('productos').innerHTML = productos;
                    /*MOSTRAR PRODUCTOS EN LA LISTA*/
                    $('#productos').multiSelect({
                        afterSelect: function(values) {
                            alert("Select value: " + values);
                            seleccionados.push(values);
                        },
                        afterDeselect: function(values) {
                            alert("Deselect value: " + values);
                            deseleccionados.push(values);
                        }
                    });
                    /*FIN MOSTRAR PRODUCTOS*/
                    document.getElementById('mostrar_proveedores').innerHTML = proovedores;
                    console.log("MOSTRAR LOS PRODUCTOS");
                    console.log(productos);

                }
            });
        }

    }

    function mostrar_precios()
    {
        var numero_formularios_cantidad=0;
        if(deseleccionados.length==0)
        {
                    
        }
    }

    function enviar_datos() {

        console.log(seleccionados);

        console.log(deseleccionados);

    }

</script>
@stop
@stop
