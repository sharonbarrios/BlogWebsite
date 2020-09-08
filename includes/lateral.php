<?php
require_once 'includes/cabecera.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
?>


<div id="container">
    <!--Barra Lateral-->
    <aside id="sidebar">

        <?php if (isset($_SESSION['usuario'])) : ?>
            <div id="usuario-logueado" class="bloque" ">
           <h3> Hola!<br> <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']; ?></h3>
          <!-- <?php var_dump($_SESSION['usuario']); ?>-->
           <!-- Botones -->
           <div class=" botones-opciones">
                <a href="crear-entradas.php" class="btn btn-outline-info">Crear Entradas</a><br>
                <a href="categorias.php" class="btn btn-outline-info">Crear Categorias</a><br>
                <a href="mis-datos.php" class="btn btn-outline-info">Mis Datos</a><br>
                <a href="logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
            </div>

</div>
<?php endif; ?>


<!-- Comprobar sino existe sesion -->
<?php if (!isset($_SESSION['usuario'])) : ?>
    <div id="login" class="bloque">
        <h3>Inicio de Sesión </h3>
        <!-- Identificar Errores de Login-->
        <?php if (isset($_SESSION['error_login'])) : ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error_login']; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Ingresar" class="btn btn-dark">
            </div>
        </form>

    </div>

    <div id="registro" class="bloque">
        <h3>Regístrate! </h3>
        <!--  MOSTRAR ERRORES -->
        <?php if (isset($_SESSION['completado'])) : ?>
            <div class="alert alert-success">
                <?= $_SESSION['completado']; ?>
            </div>
        <?php elseif (isset($_SESSION['errores']['general'])) : ?>
            <div class="alert alert-danger">
                <?= $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>

        <!--  FORMULARIO DE REGISTRO -->
        <form action="registro.php" method="POST">
            <div class="form-group">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
            </div>
            <div class="form-group">
                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese Apellido" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>
            </div>
            <div class="form-group">
                <input type="text" name="correo" id=" correo" class="form-control" placeholder="Ingrese Correo" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'correo') : ''; ?>
            </div>
            <div class="form-group">
                <input type="password" name="pass" id="pass" class="form-control" placeholder="Ingrese Contraseña" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'pass') : ''; ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Registrarse" class="btn btn-dark">
            </div>
        </form>
        <?php borrarErrores(); ?>
    </div>
<?php endif; ?>
</aside>
</div>