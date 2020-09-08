<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    //Datos del Formulario
    $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;
    $descripcion= isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']): false;
    $categoria= isset($_POST['categoria']) ? (int)$_POST['categoria']: false;
    $usuario= $_SESSION['usuario']['id'];
    $imagen= isset($_POST['imagen']) ? $_POST['imagen'] : false;

    //array de errores

    $errores= array();

    if(!empty($nombre) && !is_numeric($nombre)){
        $nombre_validado= true;
    }else{
        $nombre_validado=false;
        $errores['nombre']= "El nombre no es valido";
    }

    if(!empty($descripcion) && !is_numeric($descripcion)){
        $descripcion_validada= true;
    }else{
        $descripcion_validada=false;
        $errores['descripcion']= "La descripcion no es valida";
    }

    if(!empty($categoria)){
        $categoria_validada= true;
    }else{
        $categoria_validada=false;
        $errores['categoria']= "La categoria no es valida";
    }

    //Subir imagen a carpeta
    $archivo = $_FILES["imagen"];   
    $imagenes= $archivo["name"];
    $tipo= $archivo["type"];

//Verificar formato de la imagen
if($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/gif"){
    if(!is_dir('images')){
        mkdir('images',0777);
    }
        move_uploaded_file($archivo['tmp_name'],'images/'.$imagenes);
        echo 'imagen subida correctamente';  
}elseif(!empty($tipo)){
           
                $errores['imagen']= "El formato de la Imagen no es válido";
            
        }
    
        //Insertar o Actualizar Datos
    if(count($errores) == 0){
        if(isset($_GET['editar'])){
        $entrada_id=$_GET['editar'];
        $usuario_id= $_SESSION['usuario']['id'];
        $sql= "UPDATE entradas SET titulo='$nombre', descripcion='$descripcion', categoria_id=$categoria, imagen='$imagenes'
        WHERE id=$entrada_id AND usuario_id= $usuario_id;";
        }else{
        $sql= "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$nombre', '$descripcion', CURDATE(), '$imagenes');";
        }
        $guardar= mysqli_query($db, $sql);
        
        header('Location: index.php');
            
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            header('Location: editar-entrada.php?id='.$_GET['editar']);
            }else{
                 header('Location: crear-entradas.php');
            }
    }

    
}
