<?php
$NombreClase = $_POST['txtNombre'];
$URL = $_POST['txtURL'];
$Duracion = $_POST['txtDuracion'];
$IdVistas = $_POST['txtVistas'];
$IdNotas = $_POST['txtNotas'];

$IdCurso = $_POST['idCurso'];
$IdSeccion = $_POST['idSeccion'];
$CantidadClases = $_POST['cantidadClases'];

echo $NombreClase. $URL. $Duracion. $IdVistas. $IdNotas. $CantidadClases. $IdSeccion. $IdCurso;


include("../database/conect.php");

//
$sql = $cn->prepare("Insert into classes (name, urlVideo, duration, views, notes, classes._index, section_id, course_id) values (?,?,?,?,?,?,?,?)");
$resultado = $sql->execute([$NombreClase, $URL, $Duracion, $IdVistas, $IdNotas, $CantidadClases, $IdSeccion, $IdCurso]);

header("location: ../views/admin/editSection.php?idCurso=".$IdCurso."&idSeccion=".$IdSeccion);
