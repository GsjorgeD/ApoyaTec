<?php
$NombreSeccion = $_POST['txtNombreSeccion'];
$DescripcionSeccion = $_POST['txtDescripcionSeccion'];
$IdCurso = $_POST['idCurso'];
$CantidadSecciones = $_POST['CantidadSecciones'];

//echo $NombreSeccion." ".$DescripcionSeccion." ".$CantidadSecciones." ".$IdCurso;

include('../database/conect.php');

$sql = $cn->prepare("Insert into sections (name, description, sections.index, course_id) values (?,?,?,?)");

$resultado = $sql->execute([$NombreSeccion, $DescripcionSeccion, $CantidadSecciones, $IdCurso]);

header("location: ../views/admin/temary.php?idCurso=".$IdCurso);


?>