<?php
namespace Hagane\Controller;

class User extends AbstractController{

	function _init() {
		echo $this->db->database_log['error'];
	}

	function auth() {
		$destination = isset($_GET['dest']) ? $_GET['dest'] : $this->config['document_root'] . "index";

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['user'], $_POST['password']);
			if ($this->auth->isAuth()) {
				$this->userModel = new \Hagane\Model\User($this->auth, $this->db);
				header("Location:" . $destination);
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

				$this->userModel->setUsers($data);
		}
	}

	function ajaxUpdateUser() {
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->sendJson = true;
		$this->print_template = false;
		$this->userModel = new \Hagane\Model\User($this->auth, $this->db);

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
			$this->userModel->updateUsers($data);
		}
	}

	function ajaxGetUsers() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userModel = new \Hagane\Model\userModel($this->auth, $this->db);
		echo json_encode($this->userModel->getUsers());
	}
}

?>
