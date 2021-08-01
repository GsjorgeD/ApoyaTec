<?php

require_once '../../models/user.php';

class UserController
{
    // Coloca el head de la página y el navbar
    public function headPages(string $titlePage)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: login.php?Error=401#Modal");
        }
        require_once('../includes/headPages.php');
        require_once('../components/navbar.php');
    }
    // Coloca las importaciones de los scripts js
    public function footPages()
    {
        require_once('../components/footer.php');
        require_once('../includes/footPages.php');
    }

    // Coloca el head y el header con diseño minimalista para el login
    public function loginHeader(string $titlePage)
    {
        require_once('../includes/headPages.php');
        require_once('../components/navbarSimple.php');
    }
    // metodo que arroja un modal personalizado
    public function modal(string $title, string $description, string $mapi, bool $cancelButton, string $action, $data)
    {
        require_once('../components/modal.php');
    }

    public function cardProfile(int $user_id, int $type)
    {
        require_once('../components/cardProfile.php');
    }

    public function bannerProfile(User $user)
    {
        require_once('../components/bannerProfile.php');
    }

    public function getUserData($id)
    {
        $user = new User();
        $response = $user->getUser($id);

        if ($response != false) {
            // Casteo la respuesta a un objeto generico de php(stdClass)
            $response = $response->fetch(PDO::FETCH_OBJ);
            // Mandamos a validar la imagen
            $userController = new UserController();
            $response->picture = $userController->castImage64($response->picture);
            // Paso los valores de objt a la clase user.
            $user->construct($response);
            return $user;
        }
    }

    public function castImage64(string $picture)
    {
        if ($picture == "" || $picture == null) {
            // imagen para cuando no hay una en base de datos
            return '../../assets/svg/Mapis/Mapi-SinSuelo.svg';
        } else {
            return 'data:image/jpeg;base64,' . base64_encode($picture);
        }
    }

    public function getImage64($id)
    {
        $user = new User();
        $response = $user->getPicture($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            // devuelve el valor a colocar en el atributo src de <img>
            if ($response->picture == "" || $response->picture == null) {
                // imagen para cuando no hay una en base de datos
                echo '../../assets/svg/Mapis/Mapi-SinSuelo.svg';
            } else {
                echo 'data:image/jpeg;base64,' . base64_encode($response->picture);
            }
        }
    }

    public function userLogin($data)
    {
        session_start();

        $user = new User();
        $response  =  $user->loginUser($data['email'], $data['password']);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $_SESSION['user_id'] = $response->id;
            $_SESSION['rol_id'] = $response->rol_id;

            if ($_SESSION['rol_id'] == 3) {
                header('Location: ../admin/adminPage.php');
                die();
            } else {
                header('Location: home.php');
                die();
            }
        } else {
            header('Location: ?Error=400#Modal');
        }
    }

    public function logOut()
    {
        session_start();
        session_destroy();
        header("Location: ../../index.php");
    }

    public function getUsersRol($rol_id)
    {
        $user = new User();
        $response = $user->getUserByRol($rol_id);
        if ($response != false) {
            $users = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new UserController();
            return $controller->castUser($users);
        }
    }

    # Metodo para pasar clases genericas a clases Course
    public function castUser($usersObj)
    {
        # Creo un listado donde iran los cursos casteados a la clase Course
        $listUsers = array();
        foreach ($usersObj as $user) {
            # Le asigno la cabecera de la imagen a cada curso
            $user->picture = 'data:image/jpeg;base64,' . base64_encode($user->picture);
            $userModel = new User();
            $userModel->construct($user);
            # inserto el curso en el array
            array_push($listUsers, $user);
        }
        return $listUsers;
    }

}
