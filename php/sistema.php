<?php
    // Configuración de la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $base_datos = "portafolio";

    // Crear conexión
    $conexion = new mysqli($servidor, $usuario, $password, $base_datos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Configurar charset para caracteres especiales
    $conexion->set_charset("utf8");

    // Función para cerrar la conexión
    function cerrarConexion($conexion) {
        $conexion->close();
    }
    
    // Función en caso de un error fatal con la conexión
    function errorFatalSistemaPHP(){
        echo "Error fatal";
    }

    function consultaSelect(&$conexion, $consulta, $tipo_d, $parametros){
        $cursor = $conexion->prepare($consulta);

        if($tipo_d != ""){
            $cursor->bind_param($tipo_d, ...$parametros);
        }

        $cursor->execute();
        $resultado = $cursor->get_result();

        $lista_resultados = [];

        if($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                array_push($lista_resultados, $fila);
            }
            return $lista_resultados;
        }else{
            return 1;
        }
    } //Devuelve un array de indices numericos que contien arrays con indices alfanumericos, siendo cada uno de estos un registro de la base de datos y los indices alfanumericos las columnas de la base de datos

    function consultaInsert(&$conexion, $consulta, $tipo_d, $parametros){
        $cursor = $conexion->prepare($consulta);
        if($tipo_d != ""){
            $cursor->bind_param($tipo_d, ...$parametros);
        }

        $cursor->execute();

        if(!$conexion->commit()){
            return $conexion->connect_error;
            $conexion->rollback();
            errorFatalSistemaPHP();
        }else{
            return 0;
        }
    }


    function SubirArchivo($ruta, $enviarImagen){

        $direc_destino = $ruta;
        $archivo_destino = $direc_destino . basename($_FILES["archivo"]["name"]);
        $envioAutorizado = true;
        $tipo_archivo = strtolower(pathinfo($archivo_destino, PATHINFO_EXTENSION));

        $nombre_archivo = basename($_FILES["archivo"]["name"]);
        $contador_lineas = "-";
    
        if(isset($_POST["enviar"]) && $enviarImagen){
            $verificacion = getimagesize($_FILES["archivo"]["tmp_name"]);
            if($verificacion !== false){
                $envioAutorizado = true;
            }else{
                $envioAutorizado = false;
            }
        }

        while(file_exists($archivo_destino)){
            $archivo_destino = $direc_destino . basename($_FILES["archivo"]["name"], "." . $tipo_archivo) . $contador_lineas . "." . $tipo_archivo;
            $nombre_archivo = basename($_FILES["archivo"]["name"], "." . $tipo_archivo) . $contador_lineas . "." . $tipo_archivo;
            $contador_lineas = $contador_lineas . "-";
            echo $archivo_destino . "<br>";
        }
    
        if($_FILES["archivo"]["size"] > 3000000){
            $envioAutorizado = false;
            echo "tamaño";
        }
    
        if($tipo_archivo != "jpg" && $tipo_archivo != "png" && $tipo_archivo != "jpeg" && $tipo_archivo != "webp" && $tipo_archivo != "zip"){
            $envioAutorizado = false;
            echo "extensio";
        }
    
        if(!$envioAutorizado){
            return 1;
        }else{
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo_destino)){
                return $nombre_archivo;
            }else{
                return 1;
            }
        }
    }
    
    
    
    
    
    function FechaActual(){
        return date("Y") . "-" . date("n") . "-" . date("j");
    }
     
?>