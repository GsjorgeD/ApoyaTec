<?php
// TODO: Metodo global para obtener la imagen
    $id = $_GET['IdUser'];
    include "conexion.php";
    $sql = "select picture from usuario where id=".$id;
    $resultado = $cn->query($sql);
    $fila = $resultado->fetch(PDO::FETCH_OBJ);
    header("Content-Type: image/png");
    echo $fila->imagen;
