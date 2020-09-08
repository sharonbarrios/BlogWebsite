<?php

//Conexión

$server = 'bpgjhpb75l7ysr3kmt5g-mysql.services.clever-cloud.com:3306';
$username = 'udixljzcvnbwsfhg';
$passdb= 'vxwMNY8HmnPqtlgym9Um';
$database = 'bpgjhpb75l7ysr3kmt5g';
$db = mysqli_connect($server, $username, $passdb, $database);

mysqli_query($db, "SET NAMES 'utf8'");

// Verificar Conexión
if (!$db) {
    die("Falló la conexión: " . mysqli_connect_error());
  }

//INICIAR LA SESION

if(!isset($_SESSION)){
    session_start();
}
