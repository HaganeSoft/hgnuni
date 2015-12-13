<?php
namespace Hagane\Controller;

class Users extends AbstractController{
	
	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location:" . $this->config['document_root'] . "Users");
			 die();
		}
		include_once($this->config['appPath'].'Model/UserModel.php');
		echo $this->db->database_log['error'];
	}

	function auth() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['users'], $_POST['password']);
			if ($this->auth->isAuth()) {
				$this->user = new \Hagane\Model\UsersModel($this->auth, $this->db);
				header("Location:" . $this->config['document_root'] . "index");
			}
		}
	}

	function sign_up() {
	}

	function logout() {
		$this->auth->logout();
	}

	function index() {
	}

	function ajaxSetUsers() {
		$this->print_template = false;
		$this->sendJson = true;
		$this->usersModel = new \Hagane\Model\UserModel($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'name' => $_POST['name'],
				'country' => $_POST['country'],
				'email' => $_POST['email'],
				'address' => $_POST['address'],
				'university' => $_POST['university'],
				'phone' => $_POST['phone'],
				'degree' => $_POST['degree']);

				$this->usersModel->setUsers($data);
		}
	}

	function ajaxUpdateUsers() {
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->sendJson = true;
		$this->print_template = false;
		$this->usersModel = new \Hagane\Model\UserModel($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'id' => $request->id,
				'name' => $request->name,
				'country' => $request->country,
				'email' => $request->email,
				'address' => $request->address,
				'university' => $request->university,
				'phone' => $request->phone,
				'degree' => $request->degree);
			$this->usersModel->updateUsers($data);
		}
	}

	function ajaxGetUsers() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->usersModel = new \Hagane\Model\usersModel($this->auth, $this->db);
		echo json_encode($this->usersModel->getUsers());
	}
}

?>
