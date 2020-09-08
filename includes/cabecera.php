<?php
require_once 'includes/helpers.php';
require_once 'includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Overload</title>
  <link rel="icon" href="images/favicon.ico">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <div id="cabecera">
      <a href="index.php"><img src="assets/img/titulo.png" alt="logo"></a>
    </div>
    <!--Menu-->

    <div class="topnav" id="myTopnav">
      <a href="index.php" class="active">Inicio</a>

      <div class="categorias">
      <?php
      //Mostrar Categorías
      $categorias = conseguirCategorias($db);

      if (!empty($categorias)) :
        while ($categoria = mysqli_fetch_assoc($categorias)) :
        
           $page_id = isset($_GET['id']) ? $_GET['id'] : null;
           $id=isset($categoria['id']) ? $categoria['id'] : null;
         
      ?>
          <a href="categoria.php?id=<?= $categoria['id'] ?>" class="<?=$page_id == "$id" ? "selected" : "";?>"><?= $categoria['nombre'] ?></a>
      <?php
        endwhile;
      endif;
      ?>
      </div>
      
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
      <div class="busqueda">
        <form class="form-inline my-2 my-lg-0" action="buscar.php" method="POST">
          <input class="form-control mr-sm-2" name="busqueda" id="busqueda" placeholder="Escriba su búsqueda" required>
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
        </form>
      </div>
    </div>
    <div class"clearfix"></div>
  </header>