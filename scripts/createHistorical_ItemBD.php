
<?php
//Se inicializan las variables que llegan por el metodo GET
$idUser = $_GET['user'];
$idClass = $_GET['class'];

//Prueba para mostrar la informacion
//echo $user." ".$class;

//Se abre la conexion a la base de dato
include('../database/conect.php');

//Se genera la conexion a la base de datos
$sql = $cn->prepare("Insert into historical (user_id, class_id) values (?,?)");

//Se inyecta el comando
$resultado = $sql->execute([$idUser, $idClass]);
// echo $cn;
//Regresa a la clase para que se pueda ver
header("location: ../views/pages/class.php?class=".$idClass);

?>