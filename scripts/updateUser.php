<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
// Se almacenan los valores del formulario dentro de una variabel mediante el método POST
$idUsuario = $_POST['idUser'];
$NombreUsuario = $_POST['txtNombreUsuario'];
$Apellido = $_POST['txtApellido']; 
$Correo =  $_POST['txtCorreo'];
$Sobre = $_POST['txtSobre'];
$Rol = $_POST['cmbRol'];
$NoControl  = $_POST['txtNoControl'];

// Se hace referencia a la conexión a la base de datos
include("../database/conect.php");
if ($_FILES['imagenProducto']['name'] != null) {
    // Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
    $NombreArchivo = $_FILES['imagenProducto']['name'];
    $imagenSubida = $_FILES['imagenProducto']['tmp_name'];
    $tamanio = $_FILES['imagenProducto']['size'];
    $imagenCurso = file_get_contents($imagenSubida);
    $urlImagen = "Imagenes/";
    $extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));

    // Se hace la inyección SQL con la inserción a la tabla Courses
    $sql = $cn->prepare("update users set name=?, lastname=?, controlNumber=?, email=?, picture=?, aboutYou=?, password=?, rol_id=? where id=?");
    // Se realiza la inyección
    $resultado = $sql->execute([$NombreUsuario, $Apellido, $NoControl, $Correo, $imagenCurso, $Sobre, $NoControl, $Rol, $idUsuario]);
    // Manda automaticamente a la página cambiar rol con un mensaje de confirmación 

    header("location: ../views/admin/changeRol.php?Confirmar=403");
}else{
    // Se hace la inyección SQL con la inserción a la tabla Courses
    $sql = $cn->prepare("update users set name=?, lastname=?, controlNumber=?, email=?, aboutYou=?, password=?, rol_id=? where id=?");
    // Se realiza la inyección
    $resultado = $sql->execute([$NombreUsuario, $Apellido, $NoControl, $Correo, $Sobre, $NoControl, $Rol, $idUsuario]);
    // Manda automaticamente a la página cambiar rol con un mensaje de confirmación 

    header("location: ../views/admin/changeRol.php?Confirmar=403");
}
