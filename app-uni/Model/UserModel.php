<?php
namespace Hagane\Model;

class User {
	private $db;
	private $auth;
	private $userArray;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		// if (!empty($id)) {
			$data = array('id' => $id);
			$this->userArray = $db->getRow('SELECT * from User where User.id = :id', $data);
			$this->db = $db;
			$this->auth = $auth;
		// }
	}

	function getUser() {
		$user = $this->db->query('SELECT * FROM User');
		return $user;
	}

	function getUsername() {
		return $this->userArray['user'];
	}

	function getPassword() {}

	function setUser($data = array()) {
		return $this->db->insert('INSERT INTO User 
			SET name=:name, 
				country=:country,
		 		email=:email, 
		 		address=:address, 
		 		university=:university,
		 		phone=:phone,
		 		degree=:degree,
		 		password=:password ', $data);
	}

	function updateUser($data = array()) {
		$this->db->query('UPDATE User 
			SET name=:name, 
				country=:country, 
				email=:email, 
				address=:address, 
				university=:university,
				phone=:phone,
				degree=:degree WHERE id=:id', $data);
	}
}

?>
