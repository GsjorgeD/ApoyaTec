<?php
//Se inicializan las variables
$idUser = $_POST["idUser"];
$name = $_POST["txtName"];
$email = $_POST['txtEmail'];
$lastName = $_POST["txtLastName"];
$AboutYou = $_POST["txtAboutYou"];
$password = $_POST["txtPassword"];
echo $idUser."-".$name."-".$email."-".$lastName."-".$AboutYou."-".$password;

include('../database/conect.php');

if ($_FILES['imagenPerfilNueva']['name'] != null) {
    if ($password == "") {
        // Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
        $NombreArchivo = $_FILES['imagenPerfilNueva']['name'];
        $imagenSubida = $_FILES['imagenPerfilNueva']['tmp_name'];
        $tamanio = $_FILES['imagenPerfilNueva']['size'];
        $imagenCurso = file_get_contents($imagenSubida);
        $urlImagen = "Imagenes/";
        $extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));

        // Se hace la inyección SQL con la inserción a la tabla Courses
        $sql = $cn->prepare("update users set name=?, lastname=?, email=?, picture=?, aboutYou=? where id=?");
        // Se realiza la inyección
        $resultado = $sql->execute([$name, $lastName, $AboutYou, $email, $imagenAlumno, $AboutYou, $idUser]);
    } else {
        // Se obtienen los valores necesarios para poder guardar un tipo de dato BLOB
        $NombreArchivo = $_FILES['imagenPerfilNueva']['name'];
        $imagenSubida = $_FILES['imagenPerfilNueva']['tmp_name'];
        $tamanio = $_FILES['imagenPerfilNueva']['size'];
        $imagenCurso = file_get_contents($imagenSubida);
        $urlImagen = "Imagenes/";
        $extImagen = strtolower(pathinfo($NombreArchivo, PATHINFO_EXTENSION));

        // Se hace la inyección SQL con la inserción a la tabla Courses
        $sql = $cn->prepare("update users set name=?, lastname=?, email=?, picture=?, aboutYou=?, password=? where id=?");
        // Se realiza la inyección
        $resultado = $sql->execute([$name, $lastName, $AboutYou, $email, $imagenAlumno, $AboutYou, $password, $idUser]);
    }
    
    // Manda automaticamente a la página cambiar rol con un mensaje de confirmación 
    header("location: ../views/pages/profile.php?id=" . $idUser);
} else {
    if ($password == "") {
        // Se hace la inyección SQL con la inserción a la tabla Courses
    $sql = $cn->prepare("update users set name=?, lastname=?, email=?, aboutYou=? where id=?");
    // Se realiza la inyección
    $resultado = $sql->execute([$name, $lastName, $email, $AboutYou, $idUser]);

    } else {
        // Se hace la inyección SQL con la inserción a la tabla Courses
        $sql = $cn->prepare("update users set name=?, lastname=?, email=?, aboutYou=?, password=? where id=?");
        // Se realiza la inyección
        $resultado = $sql->execute([$name, $lastName, $email, $AboutYou, $password, $idUser]);

    }
    header("location: ../views/pages/profile.php?id=" . $idUser);
}
