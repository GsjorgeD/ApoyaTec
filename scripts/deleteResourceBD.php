<?php
// Se hace referencia a la conexión a la base de datos
include('../Database/conect.php');
//Se obtiene los valores que llegan por el metodo post
$IdCurso = $_POST['idCurso'];
$IdRecurso = $_POST['idRecurso'];
// Se prepara la inyección SQL con la cadena para la eliminación de un curso el cual se le carga el id del curso
$sql = $cn->prepare("delete from resources where id=?");
$resultado = $sql->execute([$IdRecurso]);
// Manda automaticamente a la página donde se ven todos los recursos
header("location: ../views/admin/resourcePanel.php?idCurso=".$IdCurso);
