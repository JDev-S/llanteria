@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Servicios</a></li>
            <li class="breadcrumb-item active">Agregar servicios</li>
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
                    LLena los campos para registrar un nueo servicio
                </p>
                <div class="example-wrap">

                    <div class="example">

                    </div>



                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelUsername">Nombre del servicio</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del servicio" autocomplete="off" required>
                    </div>

                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" autocomplete="off" required>
                    </div>

                    <div class="form-group form-material">
                        <label class="sr-only" for="inputUnlabelPassword">Descripción</label>
                        <!--<input type="password" class="form-control" id="inputUnlabelPassword" placeholder="Password" autocomplete="off">-->
                        <textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripción"></textarea>
                    </div>

                    <div class="form-group form-material">
                        
                        <button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar servicio</button>
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
<script type="text/javascript">

    function enviar_datos() {
        var nombre = document.getElementById("nombre").value;
        var descripcion = document.getElementById("descripcion").value;
        var precio = document.getElementById("precio").value;
        var bandera = 0;
        var mensaje = "";
        document.getElementById('mostrar_alerts').innerHTML = '';
        console.log(nombre + "  " + descripcion + "  " + "  " + precio);
        if (nombre == "" || descripcion == "" || precio == "") {
            //alert("Llene los campos");
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :Llene los campos' +
                '</div>';
            bandera = 1;
        }

        if (nombre == "" ) {
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :No ha escrito ningun nombre del servicio' +
                '</div>';
            //alert("No ha seleccionado sucursal");  
            bandera = 1;
        } else {
            bandera = 0;
            if (descripcion == "") {
                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    'Advertencia :No ha escrito ninguna descripción del servicio' +
                    '</div>';
                //alert("No ha seleccionado producto");
                bandera = 1;
            } else {
                bandera = 0;
                if (precio == "") {
                    bandera = 1;
                    mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        'Advertencia :No ha ingresado el precio' +
                        '</div>';
                    //alert("No ha ingresado la cantidad del producto");
                } else {

                    //var valoresAceptados = /^[0-9]{1,3}([\\,][0-9]{3})*[\\.][0-9]{2}$/;
                    //var valoresAceptados = /^[0-9]{1,3}([\\,][0-9]{3})$/;
                    var valoresAceptados = /^[0-9]+$/;
                    if (precio.match(valoresAceptados)) 
                    {
                         bandera = 0;
                        if(precio.length <=6)
                        {
                            bandera=0;
                            
                        }
                        else{
                             bandera = 1;
                            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            'Advertencia : El numero de digitos que ingreso son demasiados, 100000 ' +
                            '</div>';
                        }
                       

                    } else {
                        bandera = 1;
                        mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            'Advertencia :Porfavor ingrese solo numeros' +
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
            nombre: nombre,
            precio:precio,
            descripcion:descripcion,
            _token: token
        };

        $.ajax({
            type: "POST",
            url: "/agregar_servicios",
            data: data,
            success: function(msg) {
                location.href="/mostrar_servicios"
            }
        });
    }

    }
</script>
@stop
@stop
