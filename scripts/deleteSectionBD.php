<?php
$IdSeccion = $_POST['txtIdSeccion'];
$IdCurso = $_POST['txtIdCurso'];
//echo $NombreSeccion." ".$DescripcionSeccion." ".$CantidadSecciones." ".$IdCurso;

include('../database/conect.php');

$sql = $cn->prepare("DELETE FROM sections WHERE id=?");

$resultado = $sql->execute([$IdSeccion]);

header("location: ../views/admin/temary.php?idCurso=".$IdCurso);


?>