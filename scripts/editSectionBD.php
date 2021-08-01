<?php
$NombreSeccion = $_POST['txtNombreSeccion'];
$DescripcionSeccion = $_POST['txtDescripcionSeccion'];
$IdCurso = $_POST['idCurso'];
$IdSeccion = $_POST['idSeccion'];
$PosicionOriginal = $_POST['posicionOriginal']; //2
$PosicionNueva = $_POST['posicionNueva']; //5


include("../database/conect.php");

if ($PosicionNueva!="") {
    //Buscar el id de la posicion que va a ser sustituida
    $sql = "select id from sections where sections.index=".$PosicionNueva;
    $resultado =$cn->query($sql);
    $seccion = $resultado->fetch(PDO::FETCH_OBJ);
    $id= $seccion->id;
    //Cambiar el index de la seccion editada para moverlo de posición en el temario
    $sql = $cn->prepare("update sections set name=?, description=?, sections.index=? where id=?");
    $resultado = $sql->execute([$NombreSeccion, $DescripcionSeccion, $PosicionNueva,$IdSeccion]);
    
    //Cambiar de lugar la seccion que estaba en la $posicionNueva a $PosicionOriginal
    $sql1 = $cn->prepare("update sections set sections.index=? where id=?");
    $resultado1 = $sql1->execute([$PosicionOriginal, $id]);
    echo $PosicionOriginal." ".$IdCurso." ".$PosicionNueva;
}
else{
    $sql = $cn->prepare("update sections set name=?, description=? where id=?");
    $resultado = $sql->execute([$NombreSeccion, $DescripcionSeccion, $IdSeccion]);
}
header("location: ../views/admin/temary.php?idCurso=".$IdCurso);

?>