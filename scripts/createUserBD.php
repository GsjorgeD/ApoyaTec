<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
// Se almacenan los valores del formulario dentro de una variabel mediante el método POST
$NombreUsuario = $_POST['txtNombreUsuario'];
$Apellido = $_POST['txtApellido'];
$Correo =  $_POST['txtCorreo'];
$Sobre = $_POST['txtSobre'];
$Rol = $_POST['cmbRol'];
$NoControl  = $_POST['txtNoControl'];
// Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
$NombreArchivo = $_FILES['imagenProducto']['name'];
$imagenSubida = $_FILES['imagenProducto']['tmp_name'];
$tamanio = $_FILES['imagenProducto']['size'];
$imagenCurso = file_get_contents($imagenSubida);
$urlImagen = "Imagenes/";
$extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));
// Se hace referencia a la conexión a la base de datos
include("../database/conect.php");
// Se hace la inyección SQL con la inserción a la tabla Courses
$sql = $cn->prepare("Insert into users (name, lastname, controlNumber, email, picture, aboutYou, password, rol_id) 
                    values (?,?,?,?,?,?,?,?)");
// Se realiza la inyección
$resultado = $sql->execute([$NombreUsuario, $Apellido, $NoControl, $Correo, $imagenCurso, $Sobre, $NoControl, $Rol]);
// Manda automaticamente a la página cambiar rol con un mensaje de confirmación 
header("location: ../views/admin/changeRol.php");
