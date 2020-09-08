<?php

//Iniciar sesión
if(!isset($_SESSION)){
    session_start();
}

//Redirigir

if(!isset($_SESSION['usuario'])){

    header("Location: index.php");
}


?>