<?php
$user = "JonathanFF@mysql-apoyatec";
$pwd = "Monika123";
$dbname = "ApoyaTec";
//loaclhost 151.106.97.51
try {
    $cn = new PDO(
        'mysql:host=mysql-apoyatec.mysql.database.azure.com; dbname=' . $dbname,
      //'mysql:host=localhost; dbname=' . $dbname,
        $user,
        $pwd,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "Set names utf8")
    );
    // echo "Todo bien";
} catch (Exception $ex) {
    echo "Ha ocurrido el error " . $ex->getMessage();
}
