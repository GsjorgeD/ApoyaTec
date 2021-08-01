<?php
// Se piden las variables que vienen por el metodo post
$Nombre = $_POST['txtName'];
$URL = $_POST['txtLink'];

$IdCurso = $_POST['idCurso'];
$IdRecurso = $_POST['idRecurso'];

// echo $Nombre. " ". $URL. " ". $IdCurso;
include("../database/conect.php");

//Preaparando la conexion
$sql = $cn->prepare("update resources set name=?, urlResource=?, course_id=? where id=?");
$resultado = $sql->execute([$Nombre, $URL, $IdCurso, $IdRecurso]);

// Se regresa al panel despues de insertar
header("location: ../views/admin/resourcePanel.php?idCurso=".$IdCurso);