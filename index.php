<?php
require_once 'includes/cabecera.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
require_once 'includes/lateral.php'
?>



<div id="principal">
<div class="busqueda-responsive">
        <form class="form-inline my-2 my-lg-0" action="buscar.php" method="POST">
          <input class="form-control mr-sm-2" name="busqueda" id="busqueda" placeholder="Escriba su búsqueda" required>
          <button class="btn btn-dark my-2 my-sm-0" type="submit">Buscar</button>
        </form>
      </div>

<h1>Últimas entradas</h1>
        <?php 
            //Obtener datos de entradas
            $entradas= conseguirEntradas($db, true);
            if(!empty($entradas)):
                while($entrada = mysqli_fetch_assoc($entradas)):
        ?>
    <article class="entrada">
    <div>
    <?php
        //Mostrar Imagen
        if(!empty($entrada['imagen'])):
    ?>
    <img src="images/<?=$entrada['imagen']; ?>" alt="">
        <?php endif; ?>
    </div>
    <a href="entrada.php?id=<?=$entrada['id']?>">
                
        <!--Datos de Entrada-->
    <h2><?=$entrada['titulo'];  ?></h2>
    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha'];?></span>
    <p>
    <?=substr($entrada['descripcion'],0,200).".. <span class='leer'>Leer más<span>"; ?>
    </p>
</a>
    </article>
        <?php
                endwhile;
            endif;
?>

<div id="ver-todas">
<a href="entradas.php" class="btn btn-dark">Ver todas las entradas</a>
</div>
</div>

<?php require_once 'includes/footer.php'?>