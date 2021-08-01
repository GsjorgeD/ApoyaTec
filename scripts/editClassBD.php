<?php
$NombreClase = $_POST['txtNombre'];
$URL = $_POST['txtURL'];
$Duracion = $_POST['txtDuracion'];
$Vistas = $_POST['txtVistas'];
$Notas = $_POST['txtNotas'];

$IdCurso = $_POST['idCurso'];
$IdSeccion = $_POST['idSeccion'];
$IdClase = $_POST['idClase'];
$CantidadClases = $_POST['cantidadClases'];

$PosicionOriginal = $_POST['posicionOriginal'];
$PosicionNueva = $_POST['posicionNueva']; 

include("../database/conect.php");
//Si se desea cambiar la posición
if ($PosicionNueva!="") {
    //Buscar el id de la posicion que va a ser sustituida
    $sql = "select id from classes where classes._index=".$PosicionNueva;
    $resultado =$cn->query($sql);
    $seccion = $resultado->fetch(PDO::FETCH_OBJ);
    $id = $seccion->id;
    //Cambiar el index de la clase editada para moverlo de posición en el temario
    $sql = $cn->prepare("update classes set name=?, urlVideo=?, duration=?, views=?, notes=?, classes._index=? where id=?");
    $resultado = $sql->execute([$NombreClase, $URL, $Duracion, $Vistas, $Notas, $PosicionNueva, $IdClase]);
    //Cambiar de lugar la seccion que estaba en la $posicionNueva a $PosicionOriginal
    $sql = $cn->prepare("update classes set classes._index=? where id=?");
    $resultado = $sql->execute([$PosicionOriginal, $id]);
}
else{
    $sql = $cn->prepare("update classes set name=?, urlVideo=?, duration=?, views=?, notes=? where id=?");
    $resultado = $sql->execute([$NombreClase, $URL, $Duracion, $Vistas, $Notas, $IdClase]);
}

header("location: ../views/admin/editSection.php?idCurso=".$IdCurso."&idSeccion=".$IdSeccion);
?>