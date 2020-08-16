<?php
class User
{
	private $id;
	private $login;
	private $password;
	private $email;
	private $roleId;

	public function __construct(array $datas){
		$this->hydrate($datas);
	}

	public function hydrate(array $datas){
		foreach ($datas as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
			$this->$method($value);
			}
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getRoleId(){
		return $this->roleId;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setLogin(string $login){
		$this->login = $login;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function roleId($roleId){
		$this->roleId = $roleId;
	}
}