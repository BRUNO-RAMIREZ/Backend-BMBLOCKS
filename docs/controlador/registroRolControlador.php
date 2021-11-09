<?php
include_once ('../modelo/RegistroRolModelo.php');
if($_POST and $_POST['operacion']=='registroNuevoRol'){
    $nombreRol=htmlspecialchars($_POST['nombreRol']);

    $rol=new RegistroRolModelo();
    $rol->fijar('nombreRol',$nombreRol);
    $rol->registrarNuevoRol();
    //echo json_encode(array('Success'=>1,'error'=>0,'mensaje'=>'Se ha registrado correctamente'));
}else{
    echo json_encode(array('Success'=>0,'error'=>1,'mensaje'=>'Ups! no se ha realizado el registro'));
}
