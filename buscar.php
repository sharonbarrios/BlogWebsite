<?php
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

if (!isset($_POST['busqueda'])) {
    header('Location: index.php');
}
?>


<?php

// BÚSQUEDA DE ENTRADAS EN LA BASE DE DATOS


require_once 'includes/cabecera.php';
require_once 'includes/lateral.php'
?>


<div id="principal">


    <h1>Busqueda de <?= $_POST['busqueda'] ?></h1>
    <?php
    $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);

    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id'] ?>">

                    <h2><?= $entrada['titulo'];  ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha']; ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 200) . "..";    ?>
                    </p>
                </a>
            </article>
    <?php
        endwhile;
    endif;
    ?>
</div>

<?php require_once 'includes/footer.php' ?>