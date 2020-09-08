<?php
require_once 'includes/cabecera.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
?>

<div id="principal">
<h1>   Mis Datos</h1>
  <!--  MOSTRAR ERRORES -->
  <?php if(isset($_SESSION['completado'])): ?>
            <div class="alert alert-success">
            <?= $_SESSION['completado']; ?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alert alert-danger">
            <?= $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>
        
         <!--Formulario para Actualización de Datos-->
        <form action="actualizar-usuarios.php" method="POST">
        <div class="form-group">
        <label for="nombre">Ingrese Nombre: </label>
        <input class="form-control" type="text" name="nombre" id="nombre" value="<?=$_SESSION['usuario']['nombre']; ?>">
        <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
        </div>
        <div class="form-group">
        <label for="apellido">Ingrese Apellido: </label>
        <input class="form-control" type="text" name="apellido" id="apellido"  value="<?=$_SESSION['usuario']['apellidos']; ?>">
        <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>
        </div>
        <div class="form-group">
        <label for="correo">Ingrese Correo: </label>
        <input class="form-control" type="text" name="correo" id=" correo"  value="<?=$_SESSION['usuario']['email']; ?>">
        <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'], 'correo') : ''; ?>
        </div>
        <div class="form-group">
            <input type="submit" value="Actualizar Datos" class="btn btn-primary">
        </div>
        </form>
        <?php borrarErrores(); ?>  
</div>

<?php require_once 'includes/footer.php';
