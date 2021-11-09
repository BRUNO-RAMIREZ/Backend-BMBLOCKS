<?php
require_once ('conexionBase.php');
class InicioModelo {
    private $user;
    private $clave;
    private $NewConn;

    function __construct()
    {
        $this->user = "";
        $this->clave = "";
        $this->NewConn = new conexionBase();
    }

    public function fijar($key, $valor)
    {
        $this->$key = $valor;
    }

    public function validarUsuario()
    {
        date_default_timezone_set('America/Boa_Vista');
        $fecha = strftime("%Y-%m-%d");
        $hora = strftime("%H:%M:%S");
        $query = "select nombreRol,idUsuario,clave,nombres,primerApellido,segundoApellido,correoElectronico from usuario join persona p on p.idPersona = usuario.persona_idPersona join rol r on r.idRol = usuario.rol_idRol where activoUsuario=1 and nick='$this->user'";
        $this->NewConn->CreateConnection();
        $result = $this->NewConn->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->NewConn->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->NewConn->GetRows($result);
                if(password_verify($this->clave,$row[2])){
                    $key=md5($row[2]);
                    $_SESSION['nombreRol']=$row[0];
                    $_SESSION['idUsuario']=$row[1];
                    $_SESSION['key']=$key;
                    $_SESSION['nombres']=$row[3];
                    $_SESSION['primerApellido']=$row[4];
                    $_SESSION['segundoApellido']=$row[5];
                    $_SESSION['correo']=$row[6];
                    echo json_encode(array('Success' => 1,'nombreRol'=>$row[0],'idUsuario'=>$row[1],'key'=>$key,'nombres'=>$row[3],
                        'primerApellido'=>$row[4],'segundoApellido'=>$row[5],'correo'=>$row[6]));

                }
                else {

                    echo json_encode(array('Success' =>0,'Error'=>1,'Mensaje'=>'La contraseña no coincide'));
                }
            } else {
                $this->NewConn->CloseConnection();
                echo json_encode(array('Success' =>0,'Error'=>1,'Mensaje'=>'No existe el usuario'));
            }
        } else {
            $this->NewConn->CloseConnection();
            echo json_encode(array('Success' =>0,'Error'=>1,'Mensaje'=>'No se realizo la consulta correctamente'));
        }
    }
}