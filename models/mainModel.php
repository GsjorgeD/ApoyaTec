<?php

require_once '../../database/DB.php';

class MainModel extends DB
{
	public $db;
	public $string;

	public function __construct()
	{
		$this->db = new DB();
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	# Método generico para insertar en la base de datos
	public function insert($tabla, $datos)
	{
		try {
			$llaves = array_keys($datos);
			$sql = "INSERT INTO $tabla (" . implode(", ", $llaves) . ") \n";
			$sql .= "VALUES ( :" . implode(", :", $llaves) . ")";
			$q = $this->db->prepare($sql);
			return $q->execute($datos);
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		} catch (Exception $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}
	# Método generico de consulta
	public function consultQuery($query)
	{
		try {
			$consulta = $this->db->query($query);
			if ($consulta->rowCount() == 1) {
				return $consulta;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	# Método generico de consulta de varias filas
	public function consultQueryAll($query)
	{
		try {
			return $this->db->query($query);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
