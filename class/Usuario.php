<?php 

class Usuario {

	private $idusuario;
	private $login;
	private $senha;
	private $data_cadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($id){
		$this->idusuario = $id;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getDataCadastro(){
		return $this->data_cadastro;
	}

	public function setDataCadastro($data_cadastro){
		$this->data_cadastro = $data_cadastro;
	}

	public function loadById($id){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM usuarios WHERE idusuarios = :id", array(
			":id"=>$id
		));

		//var_dump($result);

		if(count($result) > 0){
			$row = $result[0];

			$this->setIdUsuario($row['idusuarios']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setDataCadastro(new DateTime($row['data_cadastro']));
		}

	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios ORDER BY login");

	}

	public static function search($login){


		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios WHERE login LIKE :search ORDER BY login", array(
			":search"=>"%".$login."%"
		));
	}

	public function login($login, $senha){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM usuarios WHERE login = :login AND senha = :senha", array(
			":login"=>$login,
			":senha"=>$senha
		));

		//var_dump($result);

		if(count($result) > 0){
			$row = $result[0];

			$this->setIdUsuario($row['idusuarios']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setDataCadastro(new DateTime($row['data_cadastro']));
		} else {
			throw new Exception("Login e/ou senha inválidos.");		
		}

	}

	public function __toString(){

		return json_encode(array(
			"idusuarios"=>$this->getIdUsuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"data_cadastro"=>$this->getDataCadastro()->format("d/m/Y H:i:s")
		));

	}
}

 ?>