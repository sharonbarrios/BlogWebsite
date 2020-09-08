<?php

//iniciar la sesión y conexión a bd
require_once 'includes/conexion.php';

//Obtener datos del formulario
if(isset($_POST)){

    // Borrar error antiguo
	if(isset($_SESSION['error_login'])){
		unset($_SESSION['error_login']);
    }
    
    //Recorger datos formulario
    $email= trim($_POST['email']);
    $password= $_POST['password'];

    //Consulta para las credenciales del usuario
    $sql= "SELECT * FROM usuarios where email= '$email'";
    $login= mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){

        $usuario= mysqli_fetch_assoc($login);

    //Comprobar la contraseña
    $verificar= password_verify($password, $usuario['password']);

         if($verificar){
        
        //Utilizar una sesión para guardar los datos del usuario logueado
        $_SESSION['usuario']= $usuario;
        }else{
        //Si algo falla enviar una sesión con el fallo
        $_SESSION['error_login']= "Login incorrecto";

        }

     } else {
            //Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login']= "Login incorrecto";
        
        }
}
//Redirigir al index.php
header('Location: index.php');

?>