@extends('welcome')
@section('contenido')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Agregar Llanta</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/principal">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Producto</a></li>
            <li class="breadcrumb-item active">Llanta</li>
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
                            <h4 class="example-title">Llena los campos para registrar una llanta</h4>
                            <div class="example">
                                <?php
               $query2 = "select * from marca ";
                $data2=DB::select($query2);      
              ?>


                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Código de la llanta</label>
                                    <input type="text" class="form-control" id="nombre_llanta" name="nombre_llanta" placeholder="Nombre de la llanta" autocomplete="off" required>
                                </div>
                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicPassword">Marca</label>
                                    <select class="form-control" id="marca" required name="marca">

                                        @foreach($data2 as $item)
                                        <option value="{{ $item->id_marca }}"> {{ $item->marca }} </option>

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
                                    <label class="form-control-label" for="inputBasicPassword">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" autocomplete="off" required>
                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Medida</label>
                                    <input type="text" class="form-control" id="medida" name="medida" placeholder="Medida" autocomplete="off" required>
                                </div>


                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Capacidad de carga</label>
                                    <input type="text" class="form-control" id="capacidad_carga" name="capacidad_carga" placeholder="Capacidad de carga" autocomplete="off" required>
                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Indice de velocidad</label>
                                    <input type="text" class="form-control" id="indice_velocidad" name="indice_velocidad" placeholder="Indice de velocidad" autocomplete="off" required>
                                </div>

                                <div class="form-group form-material">
                                    <label class="form-control-label" for="inputBasicEmail">Número de rin</label>
                                    <input type="text" class="form-control" id="numero_rin" name="numero_rin" placeholder="Número de rin" autocomplete="off" required>
                                </div>
                                <div class="form-group form-material">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary" onclick="enviar_datos();">Agregar llanta</button>
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
        var nombre_llanta = document.getElementById("nombre_llanta").value;
        var marca = document.getElementById("marca").value;
        var precio = document.getElementById("precio").value;
        var fotografia_miniatura = document.getElementById("fotografia_miniatura").files[0];
        var modelo = document.getElementById("modelo").value;
        var medida = document.getElementById("medida").value;
        var capacidad_carga = document.getElementById("capacidad_carga").value;
        var indice_velocidad = document.getElementById("indice_velocidad").value;
        var numero_rin = document.getElementById("numero_rin").value;
        var bandera = 0;
        var mensaje = "";
        document.getElementById('mostrar_alerts').innerHTML = '';
        //console.log(nombre_refaccion + "" + sucursal + "" + precio + "" + fotografia_miniatura + "" + marca + "" + modelo + "" + descripcion + "");
        console.log("Valor de fotografia_miniatura: " + fotografia_miniatura);
        if (nombre_llanta == "" || marca == "" || precio == "" || fotografia_miniatura == "" || modelo == "" || medida == "" || capacidad_carga == "" || indice_velocidad == "" || numero_rin == "") {
            //alert("Llene los campos");
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :Llene los campos' +
                '</div>';
            bandera = 1;
        }

        if (nombre_llanta == "") {
            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                'Advertencia :No ha escrito el código de la llanta' +
                '</div>';
            //alert("No ha seleccionado sucursal");  
            bandera = 1;
        } else {
            bandera = 0;
            if (marca == "") {
                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    'Advertencia :No ha seleccionado ninguna marca' +
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
                            if (modelo == "") {
                                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    'Advertencia :Porfavor ingrese el modelo de la llanta' +
                                    '</div>';
                                bandera = 1;
                            } else {
                                bandera = 0;
                                if (medida == "") {
                                    mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        'Advertencia :Porfavor ingrese la medida de la refacción' +
                                        '</div>';
                                    bandera = 1;
                                } else {
                                    bandera = 0;
                                    if (capacidad_carga == "") {
                                        bandera = 1;
                                        mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                            'Advertencia :Porfavor ingrese la capacidad de carga' +
                                            '</div>';
                                    } else {
                                        bandera = 0;
                                        if (indice_velocidad == "") {
                                            bandera = 1;
                                            mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                                '</button>' +
                                                'Advertencia :Porfavor ingrese el indice de velocidad' +
                                                '</div>';
                                        } else {
                                            bandera = 0;
                                            if (numero_rin == "") {
                                                bandera = 1;
                                                mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                    '<span aria-hidden="true">&times;</span>' +
                                                    '</button>' +
                                                    'Advertencia :Porfavor ingrese el numero de rin' +
                                                    '</div>';
                                            } else {
                                                bandera = 0;
                                                if (fotografia_miniatura == "" || fotografia_miniatura=="undefined" || fotografia_miniatura==null) {
                                                    bandera = 1;
                                                    mensaje += '<div class="alert dark alert-warning alert-dismissible" role="alert">' +
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                        '<span aria-hidden="true">&times;</span>' +
                                                        '</button>' +
                                                        'Advertencia :Porfavor ingrese una imagen de la llanta' +
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
             
             var token = '{{csrf_token()}}';
             formData.append("fotografia_miniatura", fotografia_miniatura);
             formData.append("nombre_llanta", nombre_llanta);
             formData.append("marca", marca);
             formData.append("precio", precio);
             formData.append("modelo", modelo);
             formData.append("medida", medida);
             formData.append("capacidad_carga", capacidad_carga);
             formData.append("indice_velocidad",indice_velocidad);
             formData.append("numero_rin",numero_rin);
             formData.append("_token", token);
             $.ajax({
                 type: "POST",
                 contentType: false,
                 url: "/agregar_llantas",
                 data: formData,
                 processData: false,
                 cache: false,
                 success: function(msg) {
                     location.href = "/mostrar_llantas";
                 }
             });

        }
    }

</script>
@stop
@stop
