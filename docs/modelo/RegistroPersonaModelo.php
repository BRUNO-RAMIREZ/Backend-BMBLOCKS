<?php
include_once ('conexionBase.php');
class RegistroPersonaModelo {
    private $nombres;
    private $primerApellido;
    private $segundoApellido;
    private $fechaNac;
    private $telefono;
    private $celular;
    private $direccion;
    private $email;
    private $genero;
    private $conexion;

    function __construct(){
        $this->nombres          ="";
        $this->primerApellido   ="";
        $this->segundoApellido  ="";
        $this->fechaNac         ="";
        $this->telefono         =0;
        $this->celular          =0;
        $this->direccion        ="";
        $this->email            ="";
        $this->genero           ="";
        $this->conexion         = new conexionBase();
    }
    private function verificarExistente(){
        $sql="select * from persona where nombres='$this->nombres' and primerApellido='$this->primerApellido' and genero='$this->genero' and fechaNac='$this->fechaNac'";
        $this->conexion->CreateConnection();
        $result=$this->conexion->ExecuteQuery($sql);
        $rowCount=$this->conexion->GetCountAffectedRows();
        if($rowCount > 0){
            $this->conexion->CloseConnection();
            return 1;
        }else{
            return 0;
        }
    }
    public function registrarNuevaPersona(){
        $duplicado = $this->verificarExistente();
        if($duplicado == 1){
            echo json_encode(array('Success'=>0,'Error'=>1,'Mensaje'=>'La persona ya se encuentra registrada!!!'));
        }else{
            date_default_timezone_set('America/Boa_Vista');
            $fecha=strftime("%Y-%m-%d");
            $hora=strftime("%H:%M:%S");
            $sql="insert into persona (nombres,primerApellido,segundoApellido,fechaNac,telefono,celular,direccion,correoElectronico,genero,activo,fechaRegistro)
                 values ('$this->nombres','$this->primerApellido','$this->segundoApellido','$this->fechaNac',$this->telefono,$this->celular,'$this->direccion','$this->email','$this->genero',1,'$fecha $hora')";
            $this->conexion->CreateConnection();
            $result=$this->conexion->ExecuteQuery($sql);
            if($result){
                echo json_encode(array('Success'=>1,'Error'=>0,'Mensaje'=>'Se ha realizado el registro de la persona'));
            }else{
                echo json_encode(array('Success'=>0,'Error'=>1,'Mensaje'=>'Ocurrio un error en el registro'));
            }
        }
    }
    public function fijar($atributo,$valor){
        $this->$atributo=$valor;
    }
}