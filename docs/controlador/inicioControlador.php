<?php
include_once ('../modelo/InicioModelo.php');
if($_POST and $_POST['operacion']=='InicioLogin'){
    $nick=htmlspecialchars($_POST['nick']);
    $clave=htmlspecialchars($_POST['clave']);
    $per=new InicioModelo();
    $per->fijar('user',$nick);
    $per->fijar('clave',$clave);
    $per->validarUsuario();
//    echo json_encode(array('Success'=>1,'error'=>0,'mensaje'=>'persona registrada correctamente'));
}
else{
    echo json_encode(array('Success'=>0,'error'=>1,'mensaje'=>'Post no enviado'));
}
