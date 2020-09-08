<?php
require_once 'includes/cabecera.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
require_once 'includes/lateral.php'
?>


<div id="principal">
    <h1>Entradas</h1>
    <?php
    //MOSTRAR TODAS ENTRADAS DEL BLOG
    $entradas = conseguirEntradas($db);
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id'] ?>">
                    <div>
                        <?php
                        if (!empty($entrada['imagen'])) :
                        ?>
                            <img src="images/<?= $entrada['imagen']; ?>" alt="">
                        <?php endif; ?>
                    </div>
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