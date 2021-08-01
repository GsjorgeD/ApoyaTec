<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
    // Se hace referencia a la conexión a la base de datos
    include('../database/conect.php');
    // Se realiza una condición para saber si se ha seleccionado un curso    
    if(!isset($_POST['flexRadioDefault'])){
        header("location: ../pages/deleteCourse.php?Error=403");
    }else{
        //Se obtiene el valor por POST Y se guarda el valor de un check el cual contiene el id del curso
        $idCurso = $_POST['flexRadioDefault'];
        // Se prepara la inyección SQL con la cadena para la eliminación de un curso el cual se le carga el id del curso
        $sql = $cn->prepare("delete from courses where id=?");
        // Se realiza la inyección
        $resultado = $sql->execute([$idCurso]);
        // Manda automaticamente a la página cambiar rol con un mensaje de confirmación
         header("location: ../views/admin/deleteCourse.php?Confirmar=400");
    }
?>