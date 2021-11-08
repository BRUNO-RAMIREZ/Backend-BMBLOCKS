<?php
include_once ("cabezera.php");
include_once ("header.php");
include_once ("menu.php");
session_start();
?>
<div class="col-lg-12">
    <div class="card">
        <form id="formRegistroPersona">
        <div class="card-header">
            <strong>Registro Persona</strong>
        </div>
        <div class="card-body card-block">
          
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Static</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static">Username</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nombres</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input  required id="nombres" name="nombres" type="text" placeholder="Ingrese sus nombres" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Primer Apellido</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input required id="primerApellido" name="primerApellido" type="text" placeholder="Ingrese su primer apellido" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Segundo Apellido</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input id="segundoApellido" name="segundoApellido" type="text" placeholder="Ingrese su segundo apellido" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Fecha de Nacimiento</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input required id="fechaNac" name="fechaNac" type="date" placeholder="Ingrese su fecha de nacimiento" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Telefono</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input id="telefono" name="telefono" type="number" placeholder="Ingrese su telefono" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Celular</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input required id="celular" name="celular" type="number" placeholder="Ingrese su celular" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Direccion</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input required id="direccion" name="direccion" type="text" placeholder="Ingrese su direccion" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="email-input" class=" form-control-label">Correo Electronico</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input required type="email" id="email" name="email" placeholder="Ingrese su correo electronico" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Género</label>
                    </div>
                    <div class="col col-md-9">
                        <div class="form-check">
                            <div class="radio">
                                <label for="radio1" class="form-check-label ">
                                    <input required onchange="Genero(this.value)" type="radio" id="genero" name="genero" value="Masculino" class="form-check-input">Masculino
                                </label>
                            </div>
                            <div class="radio">
                                <label for="radio2" class="form-check-label ">
                                    <input required onchange="Genero(this.value)" type="radio" id="genero" name="genero" value="Femenino" class="form-check-input">Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>
        </form>
    </div>
</div>

<?php
include_once ("scripts.php");
?>
//Scripts Externos
<script type="text/javascript">
    var generoGlobal="";
    function Genero(valor){
        generoGlobal = valor;

    }
    //validacion
    $('#nombres,#primerApellido,#segundoApellido').on('input', function () {
        this.value = this.value.replace(/[^a-zA-ZñÑáéíóú ]/g, '');
    });
    $('#telefono,#celular').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#direccion').on('input', function () {
        this.value = this.value.replace(/[^0-9#a-zA-ZñÑáéíóú., -]/g, '');
    });
    $('#formRegistroPersona').submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var nombres=$('#nombres').val();
        var primerApellido=$('#primerApellido').val();
        var segundoApellido=$('#segundoApellido').val();
        var fechaNac=$('#fechaNac').val();
        var telefono=$('#telefono').val();
        var celular=$('#celular').val();
        var direccion=$('#direccion').val();
        var email=$('#email').val();
        var genero=generoGlobal
        var formData = {
            'operacion':'registroPersona',
            'nombres':nombres,
            'primerApellido':primerApellido,
            'segundoApellido':segundoApellido,
            'fechaNac':fechaNac,
            'telefono':telefono,
            'celular':celular,
            'direccion':direccion,
            'email':email,
            'genero':generoGlobal
        }
        $.ajax({
            type: "POST",
            url: '../controlador/registroPersonaControlador.php',
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
include_once ("footer.php");?>
