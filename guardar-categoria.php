<?php
if(isset($_POST)){

    //GUARDAR CATEGORÍA EN LA BASE DE DATOS

    require_once 'includes/conexion.php';

    $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;

    //array de errores

    $errores= array();

    if(!empty($nombre) && !is_numeric($nombre)){
        $nombre_validado= true;
    }else{
        $nombre_validado=false;
        $errores['nombres']= "El nombre no es valido";
    }

    if(count($errores) == 0){

        $sql= "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $guardar= mysqli_query($db, $sql);
    }

    
}

        header('Location: index.php');
?>