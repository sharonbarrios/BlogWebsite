<?php

include_once 'includes/cabecera.php';
include_once 'includes/redireccion.php';
include_once 'includes/lateral.php';

// AÑADIR CATEGORIAS AL BLOG
?>

<div id="principal">
    <h1>Crear Categorías</h1>

    <form action="guardar-categoria.php" method="post">
        <p>
            Añade nuevas categorías al blog para que los usuario las puedan usar
            en las entradas.
        </p>
        <div class="form-group">
            <label for="nombre">Nombre de la Categoría</label>
            <input type="text" name="nombre" id="" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Guardar" class="btn btn-primary boton">
        </div>

    </form>


</div>



<?php include_once 'includes/footer.php'   ?>