<?php
$response = array();
$Cn = mysqli_connect("localhost","root","","elecciones")or die("server no encontrado");
mysqli_set_charset($Cn,"utf8");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objArray = json_decode(file_get_contents("php://input"),true);
    
    $ncontrol=$objArray['ncontrol'];
    $result = mysqli_query($Cn,"SELECT * from usuario WHERE ncontrol = '$ncontrol'");

    if (!empty($result)) {
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);
           	$usuario = array();

            $usuario["ncontrol"] = $result["ncontrol"];
            $usuario["nip"] = $result["nip"];
            $usuario['nombre_alumno'] = $result['nombre_alumno'];
            $usuario['sexo'] = $result['sexo'];
            $usuario['matricula_carrera'] = $result['matricula_carrera'];

           $response["success"] = 200;   
           $response["message"] = "Usuario encontrado";
           $response["usuario"] = array();

           array_push($response["usuario"], $usuario);

      
           echo json_encode($response);
        } else {
           
            $response["success"] = 404;  
            $response["message"] = "Visita no encontrado";
            echo json_encode($response);
        }
    } else {
        $response["success"] = 404;  
        $response["message"] = "Visita no encontrado";
        echo json_encode($response);
    }
} else {
   
    $response["success"] = 400;
    $response["message"] = "Error";

    
    echo json_encode($response);
}
mysqli_close($Cn);
?>