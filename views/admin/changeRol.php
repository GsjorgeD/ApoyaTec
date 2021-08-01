<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Usuarios');
include("../../database/conect.php");
$sql = 'select r.id as idRol, r.name as nameRol from roles as r';
$resultado1 = $cn->query($sql);
$roles1 = $resultado1->fetchAll(PDO::FETCH_OBJ);

$sql = "select u.id, CONCAT(u.name,' ', u.lastname) as nameUser, u.controlNumber, r.name as nameRol, u.rol_id from users as u inner join roles as r on u.rol_id = r.id";
$resultado = $cn->query($sql);
$usuarios1 = $resultado->fetchAll(PDO::FETCH_OBJ);

$sql = "select u.id, CONCAT(u.name,' ', u.lastname) as nameUser, u.controlNumber, r.name as nameRol, u.rol_id from users as u inner join roles as r on u.rol_id = r.id WHERE u.rol_id = 1";
$resultado = $cn->query($sql);
$usuarios2 = $resultado->fetchAll(PDO::FETCH_OBJ);

$sql = "select u.id, CONCAT(u.name,' ', u.lastname) as nameUser, u.controlNumber, r.name as nameRol, u.rol_id from users as u inner join roles as r on u.rol_id = r.id WHERE u.rol_id = 2";
$resultado = $cn->query($sql);
$usuarios3 = $resultado->fetchAll(PDO::FETCH_OBJ);

$sql = "select u.id, CONCAT(u.name,' ', u.lastname) as nameUser, u.controlNumber, r.name as nameRol, u.rol_id from users as u inner join roles as r on u.rol_id = r.id";
$resultado = $cn->query($sql);
$usuarios4 = $resultado->fetchAll(PDO::FETCH_OBJ);

$userController = new UserController();

?>
<link rel="stylesheet" href="../../assets/css/styles/admnistrador.css">

<main class="main">
    <div class="ed-grid">
        <h1>Lista de usuarios</h1>
        <h2>Seleccione un usuario para interactuar.</h2>
        <div class="ed-grid s-grid-2">
            <div class="">
                <form method="GET" action="changeRol.php" class="needs-validation" novalidate>
                    <div class="ed-grid s-grid-3">
                        <select name='cmbRoles' class="input" required>
                            <option value="0" selected>Filtro de Roles</option>
                            <?php
                            foreach ($roles1 as $rol) {
                                echo "<option value='" . $rol->idRol . "'>$rol->nameRol</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="button">Buscar</button>

                    </div>
                </form>
                <form action="../../scripts/changeRolBD.php" method="post" enctype="multipart/form-data">
                    <div class="container3">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col"></th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">No. Control</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                                <?php
                                if (!isset($_GET['cmbRoles'])) {
                                    foreach ($usuarios1 as $usuario) {
                                        echo "<tr>";
                                        echo "<td>$usuario->nameUser</td>";
                                        ?>
                                        <td><img src="<?php echo $userController->getImage64($usuario->id) ?>" width='45' height='30' style='border-radius: 150px;'></td>
                                    <?php    echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $usuario->id . "'>$usuario->nameRol</td>";
                                        echo "<td>$usuario->controlNumber</td>";
                                        echo "<td class='table-actions'>
                                        <a class='button blue s-mb-1 lg-mb-0' href='updateUsers.php?idUser=" . $usuario->id . "'>
                                            <span class='fas fa-edit'></span>
                                        </a> </td>";
                                        // echo "<td><a href='updateUsers.php?idUser=" . $usuario->id . "' class='button red'>Actualizar</a></td>";
                                        echo "</tr>";
                                    }
                                } else if ($_GET['cmbRoles'] == 1) {
                                    foreach ($usuarios2 as $usuario) {
                                        echo "<tr>";
                                        echo "<td>$usuario->nameUser</td>";
                                        ?>
                                        <td><img src="<?php echo $userController->getImage64($usuario->id) ?>" width='45' height='30' style='border-radius: 150px;'></td>
                                    <?php    echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $usuario->id . "'>$usuario->nameRol</td>";
                                        echo "<td>$usuario->controlNumber</td>";
                                        echo "<td class='table-actions'>
                                        <a class='button blue s-mb-1 lg-mb-0' href='updateUsers.php?idUser=" . $usuario->id . "'>
                                            <span class='fas fa-edit'></span>
                                        </a> </td>";
                                        echo "</tr>";
                                    }
                                } else if ($_GET['cmbRoles'] == 2) {
                                    foreach ($usuarios3 as $usuario) {
                                        echo "<tr>";
                                        echo "<td>$usuario->nameUser</td>";
                                        ?>
                                        <td><img src="<?php echo $userController->getImage64($usuario->id) ?>" width='45' height='30' style='border-radius: 150px;'></td>
                                    <?php    echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $usuario->id . "'>$usuario->nameRol</td>";
                                        echo "<td>$usuario->controlNumber</td>";
                                        echo "<td class='table-actions'>
                                        <a class='button blue s-mb-1 lg-mb-0' href='updateUsers.php?idUser=" . $usuario->id . "'>
                                            <span class='fas fa-edit'></span>
                                        </a> </td>";
                                        echo "</tr>";
                                    }
                                }else if ($_GET['cmbRoles'] == 0) {
                                    foreach ($usuarios4 as $usuario) {
                                        echo "<tr>";
                                        echo "<td>$usuario->nameUser</td>";
                                        ?>
                                        <td><img src="<?php echo $userController->getImage64($usuario->id) ?>" width='45' height='30' style='border-radius: 150px;'></td>
                                    <?php    echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $usuario->id . "'>$usuario->nameRol</td>";
                                        echo "<td>$usuario->controlNumber</td>";
                                        echo "<td class='table-actions'>
                                        <a class='button blue s-mb-1 lg-mb-0' href='updateUsers.php?idUser=" . $usuario->id . "'>
                                            <span class='fas fa-edit'></span>
                                        </a> </td>";
                                        echo "</tr>";
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="s-to-center ">
                <div>
                    <img src="../../assets/svg/mapi.svg">
                </div>
                <div class="" role="group">
                    <div>
                        <h4>Seleccione el rol al que quiere cambiar:</h4>
                    </div>
                    <select class="input s-mb-2 s-to-center column" name='cmbRol'>
                        <option value="0">Rol</option>
                        <?php
                            foreach ($roles1 as $rol) {
                                echo "<option value='" . $rol->idRol . "'>$rol->nameRol</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="">
                    <button id="btnRol" type="submit" class="button s-to-center column">Cambiar Rol</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="ed-grid">
        <div class="s-mb-4 s-to-center">
            <a class="button red s-mr-4" href="adminPage.php">Regresar</a>
            <a class="button green button-icon" href="createUser.php">Crear un nuevo usuario
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="32" height="32" rx="8" fill="#4AB75C" />
                    <path d="M16 6C21.523 6 26 10.477 26 16C26 21.523 21.523 26 16 26C10.477 26 6 21.523 6 16C6 10.477 10.477 6 16 6ZM16 7.5C13.7457 7.5 11.5837 8.39553 9.98959 9.98959C8.39553 11.5837 7.5 13.7457 7.5 16C7.5 18.2543 8.39553 20.4163 9.98959 22.0104C11.5837 23.6045 13.7457 24.5 16 24.5C18.2543 24.5 20.4163 23.6045 22.0104 22.0104C23.6045 20.4163 24.5 18.2543 24.5 16C24.5 13.7457 23.6045 11.5837 22.0104 9.98959C20.4163 8.39553 18.2543 7.5 16 7.5ZM16 11C16.1989 11 16.3897 11.079 16.5303 11.2197C16.671 11.3603 16.75 11.5511 16.75 11.75V15.25H20.25C20.4489 15.25 20.6397 15.329 20.7803 15.4697C20.921 15.6103 21 15.8011 21 16C21 16.1989 20.921 16.3897 20.7803 16.5303C20.6397 16.671 20.4489 16.75 20.25 16.75H16.75V20.25C16.75 20.4489 16.671 20.6397 16.5303 20.7803C16.3897 20.921 16.1989 21 16 21C15.8011 21 15.6103 20.921 15.4697 20.7803C15.329 20.6397 15.25 20.4489 15.25 20.25V16.75H11.75C11.5511 16.75 11.3603 16.671 11.2197 16.5303C11.079 16.3897 11 16.1989 11 16C11 15.8011 11.079 15.6103 11.2197 15.4697C11.3603 15.329 11.5511 15.25 11.75 15.25H15.25V11.75C15.25 11.5511 15.329 11.3603 15.4697 11.2197C15.6103 11.079 15.8011 11 16 11Z" fill="white" />
                </svg>
            </a>
        </div>
    </div>
</main>
<script src="../includes/layout/sweetAlert.php"></script>
<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>