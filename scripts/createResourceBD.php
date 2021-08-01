<?php
// Se piden las variables que vienen por el metodo post
$Nombre = $_POST['txtName'];
$URL = $_POST['txtLink'];

$IdCurso = $_POST['idCurso'];

echo $Nombre. " ". $URL. " ". $IdCurso;
include("../database/conect.php");

//Preaparando la conexion
$sql = $cn->prepare("Insert into resources (name, urlResource, course_id) values (?,?,?)");
$resultado = $sql->execute([$Nombre, $URL, $IdCurso]);

// Se regresa al panel despues de insertar
header("location: ../views/admin/resourcePanel.php?idCurso=".$IdCurso);
