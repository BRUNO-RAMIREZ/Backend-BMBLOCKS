<?php
include_once ('cabezera.php');
include_once ('header.php');
include_once ('menu.php');
?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="col-lg-12">
        <div class="card">
            <form id="formRegistroUsuario">
                <div class="card-header">
                    <strong>Registro Usuario</strong>
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Persona</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="js-example-basic-single form-control" name="persona" id="persona">
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nick</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input required id="nick" name="nick" type="text" placeholder="Ingrese su nick" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Clave</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input required id="clave1" name="clave1" type="password" placeholder="Ingrese su clave" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Repita su clave</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input  required id="clave2" name="clave2" type="password" placeholder="Ingrese su nick" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Registrar
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php
include_once ('scripts.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        function verificarClave(){
            var clave1 = $('#clave1').val();
            var clave2 = $('#clave2').val();
            if(clave1===clave2 && clave1!=='' && clave2!==''){
                return 1;
            }else{
                Swal.fire({
                    icon: 'Error',
                    title: 'Incorrecto',
                    text: 'Las claves no coinciden',
                })
            }
        }
        $(document).ready(function() {

        });
        $('.js-example-basic-single').select2({
            ajax: {
                url: '../modelo/ListarPersonas.php',
                dataType: 'json'
            }
        });

        //validacion
        $('#nombreRol').on('input', function () {
            this.value = this.value.replace(/[^a-zA-ZñÑáéíóú ]/g, '');
        });
        //envio del formulario
        $('#formRegistroUsuario').submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var op = verificarClave();
            if(op===1) {
                var persona = $('#persona').val();
                var nick = $('#nick').val();
                var clave1 = $('#clave1').val();
                var formData = {
                    'persona': persona,
                    'nick': nick,
                    'clave1': clave1,
                    'operacion': 'registroNuevoUsuario'
                }
                $.ajax({
                    type: "POST",
                    url: '../controlador/registroUsuarioControlador.php',
                    data: formData,
                    dataType: 'json',
                    encode: true,
                }).done(function (data) {
                    if(data.Success===1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: data.Mensaje,
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.Mensaje,
                        })
                    }
                })
            }
        })
    </script>
<?php
include_once ('footer.php');
?>