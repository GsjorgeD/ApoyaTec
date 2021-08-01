<?php

// TODO: Porque no hacer un código general para las imagenes? Ay que refactorizarlo

if (isset($_GET['flexRadioDefault'])) {
    //Recogemos el valor del id del curso mediante la variable flexRadioDefault 
    $id = $_GET['flexRadioDefault'];
    // Se hace referencia a la concexión de la base de datos
    include ("../Database/conect.php");
    // Se prepara la inyección  SQL cargandole el id del curso
    $sql = "select picture from courses where id=".$id;
    // Realizar la inyección
    $resultado = $cn->query($sql);
    // Obtener el valor del resultado
    $fila = $resultado-> fetch(PDO::FETCH_OBJ);
    // Decirle al navegador que se pondrá una imagen
    header("Content-Type: image-png");
    // Retornar la imagen
    echo $fila->picture;
    }else{
    //Recogemos el valor del id del curso mediante la variable flexRadioDefault 
    $id = $_GET['Usuario'];
    // Se hace referencia a la concexión de la base de datos
    include ("../Database/conect.php");
    // Se prepara la inyección  SQL cargandole el id del curso
    $sql = "select picture from users where id=".$id;
    // Realizar la inyección
    $resultado = $cn->query($sql);
    // Obtener el valor del resultado
    $fila = $resultado-> fetch(PDO::FETCH_OBJ);
    // Decirle al navegador que se pondrá una imagen
    header("Content-Type: image-png");
    // Retornar la imagen
    echo $fila->picture;
    }
?>