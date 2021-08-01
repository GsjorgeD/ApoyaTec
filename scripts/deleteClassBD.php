<?php
$IdCurso = $_POST['txtIdCurso'];
$IdSeccion = $_POST['txtIdSeccion'];
$IdClase = $_POST['txtIdClase'];
//echo $NombreSeccion." ".$DescripcionSeccion." ".$CantidadSecciones." ".$IdCurso;

include('../database/conect.php');

$sql = $cn->prepare("DELETE FROM classes WHERE id=?");

$resultado = $sql->execute([$IdClase]);

header("location: ../views/admin/editSection.php?idCurso=".$IdCurso."&idSeccion=".$IdSeccion);


?>