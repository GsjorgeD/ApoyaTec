<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
// Se almacenan los valores del formulario dentro de una variabel mediante el método POST
$NombreCurso = $_POST['txtNombreCurso'];
$Descripcion = $_POST['txtDescripcion']; 
$Nivel =  $_POST['txtNivel'];
$AprendizajesEsperados = $_POST['txtAEsperados'];
$ConocimientosPrevios = $_POST['txtCPNecesarios'];
$Categoria  = $_POST['txtTarget'];
$subCategoria = $_POST['cmbCategoria'];
$AsesorEncargado = $_POST['flexRadioDefault'];

// Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
$NombreArchivo = $_FILES['imagenProducto']['name'];
$imagenSubida = $_FILES['imagenProducto']['tmp_name'];
$tamanio = $_FILES['imagenProducto']['size'];

$imagenCurso = file_get_contents($imagenSubida);
$urlImagen = "Imagenes/";
$extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));
$urlArchivo = $urlImagen.$NombreCurso.".".$extImagen;
// Se hace referencia a la conexión a la base de datos
include('../database/conect.php');
// Se hace la inyección SQL con la inserción a la tabla Courses
$sql = $cn->prepare("Insert into courses (name, description, level, picture, objective, knowledge, target, user_id) 
                    values (?,?,?,?,?,?,?,?)");
// Se realiza la inyección
$resultado = $sql->execute([$NombreCurso,$Descripcion, $Nivel, $imagenCurso, $AprendizajesEsperados, 
                            $ConocimientosPrevios, $Categoria, $AsesorEncargado]);
// Se agrega el curso un tag dependiendo del que se escogio

$ultimoCurso = $cn ->lastInsertId();
echo "".$ultimoCurso;
$sql5 = $cn->prepare("Insert into course_tag (course_id, tag_id) values (?,?)");
// Se realiza la inyección

echo $subCategoria;

$resultado6 = $sql5->execute([$ultimoCurso, $subCategoria]);

// Manda automaticamente a la página cambiar rol con un mensaje de confirmación 
header("location: ../views/admin/deleteCourse.php?Confirmar=400");
