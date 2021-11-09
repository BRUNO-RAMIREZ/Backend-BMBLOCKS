<?php
include_once ('conexionBase.php');
class RegistroUsuarioModelo {
    private $persona;
    private $nick;
    private $clave;
    private $rol;
    private $conexion;
    function __construct(){
        $this->persona=null;
        $this->rol=null;
        $this->nick="";
        $this->clave="";
        $this->conexion= new conexionBase();
    }
    public function fijar($atributo,$valor){
        $this->$atributo=$valor;
    }
    private function verificarExistente(){
        $sql="select * from usuario where nick='$this->nick' and activoUsuario=1";
        $this->conexion->CreateConnection();
        $result=$this->conexion->ExecuteQuery($sql);
        $rowCount=$this->conexion->GetCountAffectedRows();
        if($rowCount>0){
            $this->conexion->CloseConnection();
            return 1;
        }else{
            return 0;
        }
    }
    public function registrarNuevoUsuario(){
        $duplicado=$this->verificarExistente();
        if($duplicado==1){
            echo json_encode(array('Success'=>0,'Error'=>1,'Mensaje'=>'El nick ya se encuentra ocupado'));
        }else{
            date_default_timezone_set('America/Boa_Vista');
            $fecha=strftime("%Y-%m-%d");
            $hora=strftime("%H:%M:%S");
            $password_seguro=password_hash($this->clave,PASSWORD_BCRYPT,['cost'=>4]);
            $sql="insert into usuario (nick, clave, activoUsuario, fechaRegistro, rol_idRol, persona_idPersona) values (
'$this->nick','$password_seguro',1,'$fecha $hora',3,$this->persona)";
            $this->conexion->CreateConnection();
            $result=$this->conexion->ExecuteQuery($sql);
            if($result){
                echo json_encode(array('Success'=>1,'Error'=>0,'Mensaje'=>'Usuario creado correctamente'));
            }else{
                echo json_encode(array('Success'=>0,'Error'=>1,'Mensaje'=>'Hubo algun error al momento de registrar el usuario'));
            }
        }

    }
}