@extends('welcome')
@section('contenido')
<!-- Page -->

<div class="page">
    <div class="page-header">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inventario</a></li>
            <li class="breadcrumb-item active">Agregar Inventario</li>
        </ol>

    </div>
    <div id="mostrar_alerts"  >
    </div>
    <div class="page-content">
        <!-- Panel Inline Form -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">
                    Servicios
                </h3>
            </header>
            <div class="panel-body">
                <p>
                    LLena los campos para registrar un nuevo producto a inventario
                </p>
                <div class="example-wrap">

                    <div class="example">


                    </div>
                    <?php
               $query2 = "select * from sucursal ";
                $data2=DB::select($query2);   
                        
                  
              ?>

                    <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                        <select class="form-control" id="sucursal" required name="sucursal" onChange="javascript:obtener_valor()">
                            <option value="0">Elige una sucursal</option>
                            @foreach($data2 as $item)
                            <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Productos</label>
                        <select class="form-control" id="mostrar_productos" required name="producto">


                        </select>
                    </div>





                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" autocomplete="off" required>
                    </div>



                    <div class="form-group form-material">

                        <!--<input type="submit" class="btn btn-primary" name="enviar" value="Agregar a inventario" onclick="enviar_datos();">-->
                        <button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar a inventario</button>
                        <!--<button type="submit" class="btn btn-primary">Crear servicio</button>-->
                    </div>


                </div>
            </div>
        </div>
        <!-- End Panel Inline Form -->

        <!-- Panel Controls Sizing -->

        <!-- End Panel Controls Sizing -->

        <!-- Panel Input Grid -->
        <!-- End Panel Input Grid -->
    </div>
</div>
<!-- End Page -->
@section('scripts')
<script src="\global\vendor\formvalidation\formValidation.min.js?v4.0.1"></script>
<script src="\global\vendor\formvalidation\framework\bootstrap4.min.js?v4.0.1"></script>
<script src="\assets\examples\js\forms\validation.min.js?v4.0.1"></script>

<script type="text/javascript">
    //
    //var valor_sucursal = sucursal.options[sucursal.selectedIndex].value;
    //console.log(sucursal);
    function obtener_valor() {
        //document.cotiza.select1[document.cotiza.select1.selectedIndex].value  
        var sucursal = document.getElementById("sucursal").value;
        document.getElementById('mostrar_alerts').innerHTML = '';
        var mensaje="";
        if(sucursal!=0)
        {
            //console.log(sucursal);
        var token = '{{csrf_token()}}';
        var data = {
            sucursal: sucursal,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/mostrar_productos",
            data: data,
            success: function(msg) {
                console.log(msg);
                //var datos=JSON.parse(msg);
                //console.log(datos);
                var productos = "";
                document.getElementById('mostrar_productos').innerHTML = '';

                for (i = 0; i < msg.length; i++) {

                    productos += '<option value="' + msg[i]['id_productos_llantimax'] + '">' + msg[i]['categoria'] + ' ' + msg[i]['nombre'] + ' ' + msg[i]['marca'] + ' ' + msg[i]['modelo'] + '</option>';

                }
                document.getElementById('mostrar_productos').innerHTML = productos
                console.log("MOSTRAR LOS PRODUCTOS");
                console.log(productos);
            }
        });
        }
        else{
             mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :Porfavor eliga una sucursal' +
                '</div>';
            document.getElementById('mostrar_alerts').innerHTML = mensaje;
            document.getElementById('mostrar_productos').innerHTML = '';
        }
        
    }

    function enviar_datos() {
        var sucursal = document.getElementById("sucursal").value;
        var producto = document.getElementById("mostrar_productos").value;
        var cantidad = document.getElementById("cantidad").value;
        var bandera = 0;
        var mensaje = "";
        document.getElementById('mostrar_alerts').innerHTML = '';
        console.log(sucursal + "  " + producto + "  " + "  " + cantidad);
        if (sucursal == "" || producto == "" || cantidad == "") {
            //alert("Llene los campos");
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :Llene los campos' +
                '</div>';
            bandera = 1;
        }

        if (sucursal == "" || sucursal==0) {
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :No ha seleccionado sucursal' +
                '</div>';
            //alert("No ha seleccionado sucursal");  
            bandera = 1;
        } else {
            bandera = 0;
            if (producto == "") {
                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    'Advertencia :No ha seleccionado producto' +
                    '</div>';
                //alert("No ha seleccionado producto");
                bandera = 1;
            } else {
                bandera = 0;
                if (cantidad == "") {
                    bandera = 1;
                    mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        'Advertencia :No ha ingresado la cantidad del producto' +
                        '</div>';
                    //alert("No ha ingresado la cantidad del producto");
                } else {

                    var valoresAceptados = /^[0-9]+$/;
                    if (cantidad.match(valoresAceptados) && parseInt(cantidad)>0 ) 
                    {
                         bandera = 0;
                        if(cantidad.length <=10 )
                        {
                            bandera=0;
                            
                        }
                        else{
                             bandera = 1;
                            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            'Advertencia : El numero de digitos que ingreso son demasiados,  Porfavor ingrese maximo 10 digitos' +
                            '</div>';
                        }
                       

                    } else {
                        bandera = 1;
                        mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            'Advertencia :Porfavor ingrese solo numeros y que sea mayor a 0' +
                            '</div>';
                        //alert("Porfavor ingrese solo numeros"); 
                    }
                }
            }
        }
        document.getElementById('mostrar_alerts').innerHTML = mensaje
        console.log("El valor de la variable bandera == " + bandera);
        if (bandera == 0) {
                    var token = '{{csrf_token()}}';
        var data = {
            sucursal: sucursal,
            cantidad:cantidad,
            producto:producto,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/agregar_inventarios",
            data: data,
            success: function(msg) {
                location.href="/mostrar_inventario"
            }
        });
    }

    }

</script>
@stop

@stop
