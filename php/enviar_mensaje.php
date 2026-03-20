<?php
    require_once("../php/sistema.php");

    $datos_crudos = file_get_contents("php://input");

    $datos_reales = json_decode($datos_crudos, true);

    $nombre = $datos_reales["nombre"];
    $email = $datos_reales["email"];
    $asunto = $datos_reales["asunto"];
    $mensaje = $datos_reales["mensaje"];

    $respuesta = [];

    $resultado = consultaInsert($conexion, "INSERT INTO `mensajes`(`nombre`, `email`, `asunto`, `mensaje`) VALUES (?, ?, ?, ?)", "ssss", [$nombre, $email, $asunto, $mensaje]);

    if($resultado != 0){
        $respuesta["estado"] = "error";
        $respuesta["mensaje"] = "Se ha producido el siguiente error: " . $resultado;
    }else{
        $respuesta["estado"] = "exitoso";
        $respuesta["mensaje"] = "Se ha enviado el mensaje con exito";
    }

    echo json_encode($respuesta);
?>