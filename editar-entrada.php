<?php
include_once 'includes/redireccion.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

$entrada_actual = conseguirEntrada($db, $_GET['id']);
if (!isset($entrada_actual['id'])) {
    header('Location: index.php');
}


//EDICIÓN DE ENTRADA
?>


<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php'
?>

<div id="principal">
    <h1>Editar Entrada</h1>
    <!--Formulario para editar entrada-->
    <form action="guardar-entrada.php?editar=<?= $entrada_actual['id'] ?>" method="post" enctype="multipart/form-data">
        <p>
            Edita tu entrada <?= $entrada_actual['titulo'] ?>
        </p>
        <div class="form-group">
            <label for="nombre">Título</label>
            <input class="form-control" type="text" name="nombre" id="" value="<?= $entrada_actual['titulo'] ?>">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'nombre') : ''; ?>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="" cols="60" rows="5">
            <?= $entrada_actual['descripcion'] ?>
            </textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>
        </div>
        <div class="form-group">
            <label for="imagen" class="form-control">Imagen</label>
            <input type="file" name="imagen" id="" class="btn">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'imagen') : ''; ?>
        </div>
        <div class="form-group">
            <label for="categoria">Categoría: </label>
            <select class="form-control" name="categoria" id="">
                <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :
                ?>
                        <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
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
            <input type="submit" value="Guardar" class="btn btn-primary boton">
        </div>

    </form>

    <?php borrarErrores(); ?>
</div>





<?php require_once 'includes/footer.php' ?>