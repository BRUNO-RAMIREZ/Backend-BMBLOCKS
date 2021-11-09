<?php
include_once ('cabezera.php');
include_once ('header.php');
include_once ('menu.php');
?>
    <div class="col-lg-12">
        <div class="card">
            <form id="formRegistroRol">
                <div class="card-header">
                    <strong>Registro Rol</strong>
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nombre Rol</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input  id="nombreRol" name="nombreRol" type="text" placeholder="Ingrese el nombre del rol" class="form-control">
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
    <script type="text/javascript">
        //validacion
        $('#nombreRol').on('input', function () {
            this.value = this.value.replace(/[^a-zA-ZñÑáéíóú ]/g, '');
        });
        $('#formRegistroRol').submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var nombreRol=$('#nombreRol').val();
            var formData = {
                'nombreRol':nombreRol,
                'operacion':'registroNuevoRol'
            }
            $.ajax({
                type: "POST",
                url: '../controlador/registroRolControlador.php',
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
        })
    </script>
<?php
include_once ('footer.php');
?>