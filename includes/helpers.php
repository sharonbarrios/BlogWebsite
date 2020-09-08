<?php
//Mostrar errores del formulario
function mostrarError($errores, $campo){
    $alerta= '';

    if(isset($errores[$campo]) && !empty($campo)){
        $alerta= "<div class='alert alert-danger'>".$errores[$campo]."</div>";       
    }

    return $alerta;
}

//Eliminar Errores
function borrarErrores(){
    $borrado= false;

    if(isset($_SESSION['errores'])){
    $_SESSION['errores']=null;
    $_SESSION['completado']=null;
    $borrado= true;
}


if(isset($_SESSION['completado'])){
    $_SESSION['completado']=null;
    $borrado= true;
}

if(isset($_SESSION['errores_entrada'])){
    $_SESSION['errores_entrada']=null;
 
}

if(isset($_SESSION['error_login'])){
    $_SESSION['error_login']=null;
    $borrado= true;
}
    return $borrado;
}


//Obtener categorías de la BD
function conseguirCategorias($conexion){
    $sql= "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias= mysqli_query($conexion, $sql);

    $resultado= array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado= $categorias;
    }

    return $resultado;
}

//Obtener categoría por Id
function conseguirCategoria($conexion, $id){
    $sql= "SELECT * FROM categorias where id= $id ORDER BY id ASC;";
    $categorias= mysqli_query($conexion, $sql);

    $resultado= array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado= mysqli_fetch_assoc($categorias);
    }

    return $resultado;
}

//Obtener datos de las Entradas al blog
function conseguirEntradas($conexion, $limite = null, $categoria = null, $busqueda=null){
    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id ORDER BY e.id DESC";

    if(!empty($categoria)){
        $sql= "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id WHERE e.categoria_id=$categoria ORDER BY e.id DESC";
    }

    if(!empty($busqueda)){
        $sql= "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id 
        WHERE e.titulo LIKE '%$busqueda%' ORDER BY e.id DESC";
    }

    if($limite){
        $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id ORDER BY e.id DESC LIMIT 4";

    }



    $entradas= mysqli_query($conexion, $sql);

    $resultado= array();

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
    }

    return $entradas;
}


//Obtener datos de entrada por Id
function conseguirEntrada($conexion, $id){
 
    $sql="SELECT e.*, c.nombre AS 'Categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' 
    FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id
    INNER JOIN usuarios u ON  e.usuario_id=u.id WHERE e.id= $id;";

    $entrada= mysqli_query($conexion, $sql);
    $resultado= array();

    if($entrada && mysqli_num_rows($entrada)>=1){
        $resultado= mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}
