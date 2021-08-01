<!-- Se abre la etiqueta php para poder escribir código php -->
<?php
// Por el método POST Se guarda el valor de flexRadioDefault el cual guarda el valor del id a $idUsuario
// mediante el check  
$idUsuario = $_POST['flexRadioDefault'];
// Por el método POST se guarda el valor del rol a cambiar mediante el select 
$rol = $_POST['cmbRol'];
// Se hace referencia a la clase php donde se realiza la conexión a la base de datos
include("../database/conect.php");
// Condición para verificar que el usuario haya seleccionado algún usuario
if ($idUsuario != '') {
    // Se hace una inyección SQL mediante la extensión PDO
    // Se manda la cadena de una actualización a la tabla rolId en cual le mandamos el id del rol y el id del usuario
    $sql = $cn->prepare("update users set rol_id=? where id=?");
    // Se ejecuta la inyección 
    $resultado = $sql->execute([$rol, $idUsuario]);
    // Direcciona automaticamente a la clase cambiar rol si es que no hubo ningún error
    echo $idUsuario;
    header("location: ../views/admin/changeRol.php");
} else {
    // Direcciona automaticamente a la clase cambiar rol con un mensaje de error
    header("location: ../views/admin/changeRol.php?Error=402");
}
?>