@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Refacción</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Producto</a></li>
            <li class="breadcrumb-item active">Refacción</li>
        </ol>

    </div>
    <div id="mostrar_alerts">
    </div>
    <div class="page-content">

        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    <div class="col-md-6">
                        <!-- Example Basic Form (Form grid) -->
                        <div class="example-wrap">
                            <h4 class="example-title">Llena los campos para ingresar una nueva refacción</h4>
                            <div class="example">
                                <?php
                                    $query2 = "select * from sucursal ";
                                    $data2=DB::select($query2);      
                                    ?>
                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Código de la refacción</label>
                                    <input type="text" class="form-control" id="nombre_refaccion" name="nombre_refaccion" placeholder="Nombre de la refacción" autocomplete="off" required>
                                </div>
                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Sucursal</label>
                                    <select class="form-control" id="sucursal" required name="sucursal" required>

                                        @foreach($data2 as $item)
                                        <option value="{{ $item->id_sucursal }}"> {{ $item->sucursal }} </option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicEmail">Foto</label>
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                <i class="icon md-upload" aria-hidden="true"></i>
                                                <input type="file" name="fotografia_miniatura" id="fotografia_miniatura" required>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <!--<div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicPassword">Foto</label>
                                        <input type="file" class="form-control" id="fotografia_miniatura" name="fotografia_miniatura">
                                    </div>-->


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
                                    <label class="form-control-label" for="inputBasicEmail">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" autocomplete="off" required>
                                </div>
                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" autocomplete="off" required>
                                </div>
                                <div class="form-group form-material">
                                    <label class="sr-only" for="inputUnlabelPassword">Descripción</label>
                                    <!--<input type="password" class="form-control" id="inputUnlabelPassword" placeholder="Password" autocomplete="off">-->
                                    <textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripción"></textarea>
                                </div>

                                <div class="form-group form-material">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar refacción</button>
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

@section('scripts')
<script type="text/javascript">
    function enviar_datos() {
        var nombre_refaccion = document.getElementById("nombre_refaccion").value;
        var sucursal = document.getElementById("sucursal").value;
        var precio = document.getElementById("precio").value;
        var fotografia_miniatura = document.getElementById("fotografia_miniatura").files[0];
        //var file = this.files[0];
        var marca = document.getElementById("marca").value;
        var modelo = document.getElementById("modelo").value;
        var descripcion = document.getElementById("descripcion").value;

        var bandera = 0;
        var mensaje = "";
        document.getElementById('mostrar_alerts').innerHTML = '';
        //console.log(nombre_refaccion + "" + sucursal + "" + precio + "" + fotografia_miniatura + "" + marca + "" + modelo + "" + descripcion + "");
        console.log("Valor de fotografia_miniatura: " + fotografia_miniatura);
        if (nombre_refaccion == "" || sucursal == "" || precio == "" || fotografia_miniatura == "" || marca == "" || modelo == "" || descripcion == "") {
            //alert("Llene los campos");
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :Llene los campos' +
                '</div>';
            bandera = 1;
        }

        if (nombre_refaccion == "") {
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :No ha escrito el código de la refacción' +
                '</div>';
            //alert("No ha seleccionado sucursal");  
            bandera = 1;
        } else {
            bandera = 0;
            if (sucursal == "") {
                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    'Advertencia :No ha seleccionado ninguna sucursal' +
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
                    if (precio.match(valoresAceptados)) {
                        bandera = 0;
                        if (precio.length <= 6) {
                            bandera = 0;
                            /*Nuevo if*/
                            if (marca == "") {
                                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    'Advertencia :Porfavor ingrese la marca de la refacción' +
                                    '</div>';
                                bandera = 1;
                            } else {
                                bandera = 0;
                                if (modelo == "") {
                                    mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        'Advertencia :Porfavor ingrese el modelo de la refacción' +
                                        '</div>';
                                    bandera = 1;
                                } else {
                                    bandera = 0;
                                    if (descripcion == "") {
                                        bandera = 1;
                                        mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                            'Advertencia :Porfavor ingrese una descripcion de la refacción' +
                                            '</div>';
                                    } else {
                                        bandera = 0;
                                        if (fotografia_miniatura == "" || fotografia_miniatura == "undefined" || fotografia_miniatura == null) {
                                            bandera = 1;
                                            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                                '</button>' +
                                                'Advertencia :Porfavor ingrese una imagen de la refacción' +
                                                '</div>';
                                        } else {
                                            bandera = 0;

                                            var extension = fotografia_miniatura.type;
                                            if (extension == 'image/jpg' || extension == 'image/jpeg' || extension == 'image/png' || extension == 'image/svg' || extension == 'image/bmp' || extension == 'image/JPG' || extension == 'image/JPEG' || extension == 'image/PNG' || extension == 'image/SVG' || extension == 'image/BMP') {
                                                bandera = 0;
                                            } else {
                                                bandera = 1;
                                                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                    '<span aria-hidden="true">&times;</span>' +
                                                    '</button>' +
                                                    'Advertencia : Solo acepta imagenes con extension .png, .jpg, .jpeg, .bmp y .svg' +
                                                    '</div>';
                                            }
                                        }
                                    }
                                }

                            }
                            /*FIN NUEVO IF*/

                        } else {
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

            var formData = new FormData();
            //var filesLength = document.getElementById('fotografia_miniatura').files.length;
            /*for (var i = 0; i < filesLength; i++) {
                formData.append("file[]", document.getElementById('fotografia_miniatura').files[i]);
            }*/
            var token = '{{csrf_token()}}';
            formData.append("fotografia_miniatura", fotografia_miniatura);
            formData.append("nombre_refaccion", nombre_refaccion);
            formData.append("sucursal", sucursal);
            formData.append("precio", precio);
            formData.append("marca", marca);
            formData.append("modelo", modelo);
            formData.append("descripcion", descripcion);
            formData.append("_token", token);
            $.ajax({
                type: "POST",
                contentType: false,
                url: "/agregar_refacciones",
                data: formData,
                processData: false,
                cache: false,
                success: function(msg) {
                    location.href = "/mostrar_refacciones";
                }
            });

        }
    }

</script>
@stop
@stop
