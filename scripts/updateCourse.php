<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
// Se almacenan los valores del formulario dentro de una variabel mediante el método POST
$idCurso = $_POST['idCurso'];
$NombreCurso = $_POST['txtNombreCurso'];
$Descripcion = $_POST['txtDescripcion']; 
$Nivel =  $_POST['txtNivel'];
$AprendizajesEsperados = $_POST['txtAEsperados'];
$ConocimientosPrevios = $_POST['txtCPNecesarios'];
$Categoria  = $_POST['txtTarget'];
$AsesorEncargado = $_POST['flexRadioDefault'];

//echo $idCurso."-".$NombreCurso."-".$Descripcion."-".$Nivel."-".$AprendizajesEsperados."-".$ConocimientosPrevios."-".$Categoria."-".$AsesorEncargado;
// Se hace referencia a la conexión a la base de datos
include("../database/conect.php");
if($_FILES['imagenProducto']['name'] != null){
    // Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
    $NombreArchivo = $_FILES['imagenProducto']['name'];
    $imagenSubida = $_FILES['imagenProducto']['tmp_name'];
    $tamanio = $_FILES['imagenProducto']['size'];
    $imagenCurso = file_get_contents($imagenSubida);
    $urlImagen = "Imagenes/";
    $extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));
    $urlArchivo = $urlImagen . $NombreCurso . "." . $extImagen;
    move_uploaded_file($imagenSubida, $urlArchivo);
    // Se hace la inyección SQL con la inserción a la tabla Courses
    $sql = $cn->prepare("update courses set name=?, description=?, level=?, picture=?, objective=?, knowledge=?, target=?, user_id=? where id=?");
    // Se realiza la inyección
    $resultado = $sql->execute([
        $NombreCurso, $Descripcion, $Nivel, $imagenCurso, $AprendizajesEsperados,
        $ConocimientosPrevios, $Categoria, $AsesorEncargado, $idCurso
    ]);
    // Manda automaticamente a la página cambiar rol con un mensaje de confirmación 
    header("location: ../views/admin/deleteCourse.php?Confirmar=402");
}else{

    $sql = $cn->prepare("update courses set name=?, description=?, level=?, objective=?, knowledge=?, target=?, user_id=? where id=?");
    // Se realiza la inyección
    $resultado = $sql->execute([
        $NombreCurso, $Descripcion, $Nivel, $AprendizajesEsperados,
        $ConocimientosPrevios, $Categoria, $AsesorEncargado, $idCurso
    ]);
    // Manda automaticamente a la página cambiar rol con un mensaje de confirmación 
    header("location: ../views/admin/deleteCourse.php?Confirmar=402");
}

