<?php

require_once '../../models/mainModel.php';

class User extends MainModel
{
	public int $id;
	public string $name;
	public string $lastName;
	public string $controlNumber;
	public string $email;
	public string $picture;
	public string $aboutYou;
	// public $password;
	public int $rol_id;

	public function __construct()
	{
		parent::__construct();
	}

	public function construct($data)
	{
        $this->id = $data->id;
        $this->name = $data->name;
        $this->lastName = $data->lastname;
        $this->controlNumber = $data->controlNumber;
        $this->email = $data->email;
        $this->picture = $data->picture;
        $this->aboutYou = $data->aboutYou;
		// $this->password = $data->password;
        $this->rol_id = $data->rol_id;
	}

	function getName()
	{
		return $this->name;
	}

	function getLastName()
	{
		return $this->lastName;
	}

	function getControlNumber()
	{
		return $this->controlNumber;
	}

	function getEmail()
	{
		return $this->email;
	}

	function getAboutYou()
	{
		return $this->aboutYou;
	}

	// function getPassword()
	// {
	// 	return $this->password;
	// }

	function getRolId()
	{
		return $this->rol_id;
	}

	function setId($id)
    {
        $this->id = $id;
    }

	function setName($name)
	{
		$this->name = $name;
	}

	function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	function setControlNumber($controlNumber)
	{
		$this->controlNumber = $controlNumber;
	}

	function setEmail($email)
	{
		$this->email = $email;
	}

	function setAboutYou($aboutYou)
	{
		$this->aboutYou = $aboutYou;
	}

	// function setPassword($password)
	// {
	// 	$this->password = $password;
	// }

	function setRolId($rol_id)
	{
		$this->rol_id = $rol_id;
	}

	// function guardarUsuario($datos) {
	// 	$db = new mainModel();
	// 	$datos['id_rol'] = 2;
	// 	$insertar = $db->insertar('usuarios', $datos);
	// 	if ($insertar == true) {
	// 		$_SESSION['mensaje'] = 'Registro exitoso';
	// 	}
	// }

	# Consulta para saber si el usuario esta registrado
	public function loginUser($email, $password)
	{
		$db = new MainModel();
		$query = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "'";
		return $response = $db->consultQuery($query);
	}
	# obtiene la imagen de un usurio mediante su id
	public function getPicture(int $id)
	{
		$db = new MainModel();
		$query = "SELECT picture FROM users WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}
	# Obtiene un solo usario mediante su id
	public function getUser(int $id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM users WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}

	public function getUserByRol(int $rol_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM users WHERE rol_id =" . $rol_id;
		return $response = $db->consultQueryAll($query);
	}

}
