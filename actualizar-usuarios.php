<?php
   //ACTUALIZACIÓN DE DATOS DE USUARIO
if(isset($_POST)){
  
    require_once 'includes/conexion.php';

    $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido= isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']): false;
    $correo= isset($_POST['correo']) ? mysqli_real_escape_string($db, $_POST['correo']): false;

    //array de errores
    $errores= array();

    //validar datos en la bd

    //validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        echo "El nombre es valido";
        $nombre_validado= true;
    }else{
        $nombre_validado=false;
        $errores['nombre']= "El nombre no es valido";
    }

    //validar apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
        echo "El apellido es valido";
        $apellido_validado= true;
    }else{
        $apellido_validado=false;
        $errores['apellido']= "El apellido no es valido";
    }

    //validar correo
    if(!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)){
        echo "El correo es valido";
        $correo_validado= true;
    }else{
        $correo_validado=false;
        $errores['correo']= "El correo no es valido";
    }

   $guardar_usuario= false;


// controlador de errores

   if(count($errores) == 0){
       //insertar a la base de datos
       $usuario= $_SESSION['usuario']['id'];
       $guardar_usuario=true;

       //Comprobar que el email no existe
        $sqlq = "SELECT id, email from usuarios where email= '$correo'";
        $isset_email= mysqli_query($db, $sqlq);
        $isset_user= mysqli_fetch_assoc($isset_email);

        if($isset_user['id']== $usuario || empty($isset_user)){
        
            //Actualizar datos en la tabla
        

        $sql= "UPDATE usuarios SET nombre='$nombre', apellidos='$apellido', email='$correo' WHERE id= $usuario";
        $guardar= mysqli_query($db, $sql);

        if($guardar){
            $_SESSION['usuario']['nombre']= $nombre;
            $_SESSION['usuario']['apellidos'] = $apellido;
            $_SESSION['usuario']['email']= $correo;

            $_SESSION['completado']= 'Tus datos se han actualizado con éxito';
        }else{
            $_SESSION['errores']['general']= 'Fallo al actualizar';

        }
    }else{
        $_SESSION['errores']['general']= 'El correo ya está registrado';

    }
   }else{
        $_SESSION['errores']= $errores;
       
   }
}
    header('Location: mis-datos.php');
