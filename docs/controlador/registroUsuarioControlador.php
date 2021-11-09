<?php
print_r($_POST);
include_once ('../modelo/RegistroUsuarioModelo.php');
if($_POST and $_POST['operacion']=='registroNuevoUsuario'){
    $persona=htmlspecialchars($_POST['persona']);
    $nick=htmlspecialchars($_POST['nick']);
    $clave=htmlspecialchars($_POST['clave1']);
    $per=new RegistroUsuarioModelo();
    $per->fijar('persona',$persona);
    $per->fijar('clave',$clave);
    $per->fijar('nick',$nick);
    $per->registrarNuevoUsuario();

//    echo json_encode(array('Success'=>1,'error'=>0,'mensaje'=>'persona registrada correctamente'));
}
else{
    echo json_encode(array('Success'=>0,'error'=>1,'mensaje'=>'Post no enviado'));
}