<?php
$response = array();
$Cn = mysqli_connect("localhost","root","","elecciones")or die("server no encontrado");
mysqli_set_charset($Cn,"utf8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $objArray  =json_decode(file_get_contents("php://input"),true);
    if(empty($objArray)){
        $response['success'] = 400;
        $response['message'] = "Falta Información";
        echo json_encode($response);
    }else {
        $id = $objArray['id_candidato'];
        $descripcion = $objArray['descripcion'];
        $propuesta = $objArray['propuesta'];
        $ncontrol = $objArray['ncontrol'];
        $result = mysqli_query($Cn,"INSERT INTO candidato(id_candidato,descripcion,propuesta,ncontrol) VALUES($id,'$descripcion','$propuesta','$ncontrol')");
        if($result){
            $response['success'] = 200;
            $response['message'] = "Registro exixtoso";
            echo json_encode($response);
        }else {
            $response['success'] = 406;
            $response['message'] = "Error al registrar, intente nuevamente";
            echo json_encode($response);
        }
    }
}else {
    $response["success"] = 400;
    $response["message"] = "Faltan Datos entrada";
    echo json_encode($response);
}
?>