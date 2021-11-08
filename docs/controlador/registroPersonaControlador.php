<?php
include_once ('../modelo/RegistroPersonaModelo.php');
if($_POST and $_POST['operacion']=='registroPersona'){
    $nombres=htmlspecialchars($_POST['nombres']);
    $primerApellido=htmlspecialchars($_POST['primerApellido']);
    $segundoApellido=htmlspecialchars($_POST['segundoApellido']);
    $fechaNac=htmlspecialchars($_POST['fechaNac']);
    $telefono=htmlspecialchars($_POST['telefono']);
    $celular=htmlspecialchars($_POST['celular']);
    $direccion=htmlspecialchars($_POST['direccion']);
    $email=htmlspecialchars($_POST['email']);
    $genero=htmlspecialchars($_POST['genero']);
    $persona=new RegistroPersonaModelo();
    $persona->fijar('nombres',$nombres);
    $persona->fijar('primerApellido',$primerApellido);
    $persona->fijar('segundoApellido',$segundoApellido);
    $persona->fijar('fechaNac',$fechaNac);
    $persona->fijar('telefono',$telefono);
    $persona->fijar('celular',$celular);
    $persona->fijar('direccion',$direccion);
    $persona->fijar('email',$email);
    $persona->fijar('genero',$genero);
    $persona->registrarNuevaPersona();
    //echo json_encode(array('Success'=>1,'error'=>0,'mensaje'=>'Se ha registrado correctamente'));
}else{
    echo json_encode(array('Success'=>0,'error'=>1,'mensaje'=>'Ups! no se ha realizado el registro'));
}
