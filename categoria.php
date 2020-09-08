<?php
require_once 'includes/cabecera.php';
require_once 'includes/helpers.php';

//DATOS DE LAS CATEGORIAS
$categoria = conseguirCategoria($db, $_GET['id']);
if (!isset($categoria['id'])) {
    header('Location: index.php');
}
?>


<?php
require_once 'includes/conexion.php';
require_once 'includes/lateral.php';

//PÁGINA PRINCIPAL QUE MUESTRA LAS ENTRADAS MÁS RECIENTES
?>


<div id="principal">


    <h1>Entradas de <?= $categoria['nombre'] ?></h1>
    <?php

    $entradas = conseguirEntradas($db, null, $_GET['id']);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id'] ?>">

                    <?php
                    if (!empty($entrada['imagen'])) :
                    ?>
                        <img src="images/<?= $entrada['imagen']; ?>" alt="">
                    <?php endif; ?>

                    <h2><?= $entrada['titulo'];  ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha']; ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 200) . ".. <span class='leer'>Leer más<span>";    ?>
                    </p>
                </a>
            </article>
    <?php
        endwhile;
    endif;
    ?>
</div>

<?php require_once 'includes/footer.php' ?>