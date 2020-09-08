<?php
   
if(isset($_POST)){
  
    require_once 'includes/conexion.php';
   
   if(isset($_SESSION)){
    session_start();
   }

   //Datos del Formulario
    $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido= isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']): false;
    $correo= isset($_POST['correo']) ? mysqli_real_escape_string($db, $_POST['correo']): false;
    $password= isset($_POST['pass']) ? mysqli_real_escape_string($db, $_POST['pass']): false;

    //array de errores
    $errores= array();


    //validar datos en la bd

    //validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        echo "El nombre es válido";
        $nombre_validado= true;
    }else{
        $nombre_validado=false;
        $errores['nombre']= "El nombre no es válido";
    }

    //validar apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
        echo "El apellido es válido";
        $apellido_validado= true;
    }else{
        $apellido_validado=false;
        $errores['apellido']= "El apellido no es válido";
    }

    //validar correo
    if(!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)){
        echo "El correo es válido";
        $correo_validado= true;
    }else{
        $correo_validado=false;
        $errores['correo']= "El correo no es válido";
    }

    //validar contraseña
    if(!empty($password) ){
        echo "La contraseña es válida";
        $pass_validado= true;
    }else{
        $pass_validado=false;
        $errores['pass']= "La contraseña no es válida";
    }


   $guardar_usuario= false;


// controlador de errores

   if(count($errores) == 0){
       //insertar a la base de datos
       $guardar_usuario=true;

    //cifrar la contraseña

    $password_segura= password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    var_dump($password);
    var_dump($password_segura);

        //insertar datos en la tabla
        $sql= "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$correo', '$password_segura', CURDATE());";
        $guardar= mysqli_query($db, $sql);
     
        if($guardar){
            $_SESSION['completado']= 'El registro se ha completado';
        }else{
            $_SESSION['errores']['general']= 'Hubo un fallo al guardar el usuario';

        }

   }else{
        $_SESSION['errores']= $errores;
       
   }
}
    header('Location: index.php');
