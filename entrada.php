<?php
    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    //obtener datos de entrada
    $entrada_actual= conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
        header('Location: index.php');
    }
?>


<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';

// MOSTRAR DATOS DE LA ENTRADA
?>


<div id="principal">

<div class="centrado">
    <?php
        if(!empty($entrada_actual['imagen'])):
    ?>
    <img src="images/<?=$entrada_actual['imagen']; ?>" alt="">
        <?php endif; ?>
</div>

<h1><?=$entrada_actual['titulo']?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
       <h2><?=$entrada_actual['Categoria']?></h2>
        </a>
       <h4><?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario']?></h4>
       <p>
       <?=$entrada_actual['descripcion']?>
       </p>


       <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id']== $entrada_actual['usuario_id']): ?>

        <!--Botones-->
        <a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="btn btn-primary boton">Editar Entrada</a>
        <a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="btn btn-danger boton">Eliminar</a>
       <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'?>