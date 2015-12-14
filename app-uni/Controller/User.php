<?php
namespace Hagane\Controller;

class User extends AbstractController{
	function _init() {
		/*if (!$this->auth->isAuth()) {
		             header("Location:" . $this->config['document_root'] . "index");
		             die();
		        }*/
		include_once($this->config['appPath'].'Model/UserModel.php');
		echo $this->db->database_log['error'];
	}

	function auth() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['user'], $_POST['password']);
			if ($this->auth->isAuth()) {
				$this->user = new \Hagane\Model\User($this->auth, $this->db);
				header("Location:" . $this->config['document_root'] . "index");
			}
		}
	}

	function logout() {
		$this->auth->logout();
	}

	function index() {
	}

	function ajaxSetUser() {
		$this->print_template = false;
		$this->sendJson = true;
		$this->userModel = new \Hagane\Model\User($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'name' => $_POST['name'],
				'country' => $_POST['country'],
				'email' => $_POST['email'],
				'address' => $_POST['address'],
				'university' => $_POST['university'],
				'phone' => $_POST['phone'],
				'degree' => $_POST['degree']);
			if( $this->userModel->setUser($data) != NULL ){
				header("Location:" . $this->config['document_root'] . "index");
			}
		}
		echo "error";
	}

	function ajaxUpdateUser() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userModel = new \Hagane\Model\User($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'id' => $_POST['id'],
				'name' => $_POST['name'],
				'country' => $_POST['country'],
				'email' => $_POST['email'],
				'address' => $_POST['address'],
				'university' => $_POST['university'],
				'phone' => $_POST['phone'],
				'degree' => $_POST['degree'],
				'password' => $_POST['password']);
		}
	}

	function ajaxGetUser() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userModel = new \Hagane\Model\User($this->auth, $this->db);
		echo json_encode($this->userModel->getUser());
	}

	function sign_up() {
	}
}

?>
