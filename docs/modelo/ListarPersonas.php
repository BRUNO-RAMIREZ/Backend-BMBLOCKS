<?php
include_once ('conexionBase.php');
$persona=new conexionBase();
$sql="select * from persona left join usuario u on persona.idPersona = u.persona_idPersona where activo=1 and activoUsuario is null";
$persona->CreateConnection();
$result=$persona->ExecuteQuery($sql);
if($result){
    $rowCount=$persona->GetCountAffectedRows();
    if($rowCount > 0){
        $persona->CloseConnection();
        $datos=array();
        while ($row=$persona->GetRows($result)){
            $datos['results'][]=['id'=>$row[0],'text'=>$row[1].' '.$row[2].' '.$row[3]];
        }
        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
}
;
