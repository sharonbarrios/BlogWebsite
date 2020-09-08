<?php

include_once 'includes/cabecera.php';
include_once 'includes/redireccion.php';
include_once 'includes/lateral.php';

//CREACIÓN DE ENTRADAS
?>

<div id="principal">
    <h1>Crear Entradas</h1>

    <!--Formulario Entradas-->
    <form action="guardar-entrada.php" method="post" enctype="multipart/form-data">
        <p>
            Añade nuevas Entradas al blog para que los usuarios usuarios puedan leerlas
        </p>
        <div class="form-group">
            <label for="nombre">Título</label>
            <input type="text" name="nombre" id="" class="form-control">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'nombre') : ''; ?>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="" cols="60" rows="5" class="form-control"></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>
        </div>
        <div class="form-group">
            <label for="imagen" class="form-control">Imagen</label>
            <input type="file" name="imagen" id="" class="btn">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'imagen') : ''; ?>
        </div>
        <div class="form-group">
            <label for="categoria">Categoría: </label>
            <select name="categoria" id="" class="form-control">
                <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :
                ?>
                        <option value="<?= $categoria['id'] ?>">
                            <?= $categoria['nombre'] ?>
                        </option>
                <?php
                    endwhile;
                endif;
                ?>

            </select>
            
            <!--Mostrar Errores si existen-->
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>
        </div>
        <div class="form-group">
            <input type="submit" value="Guardar" class="btn btn-primary">
        </div>

    </form>

    <?php borrarErrores(); ?>
</div>



<?php include_once 'includes/footer.php'   ?>