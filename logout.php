<?php

session_start();


//Eliminar sesión de Usuario
if(isset($_SESSION['usuario'])){
    session_destroy();
}

header('Location: index.php');


?>