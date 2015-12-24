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
			} else {
				header("Location:" . $this->config['document_root'] . "login");
			}
		}

		die();
	}

	function logout() {
		$this->auth->logout();
	}

	function index() {
	}

	function generatePassword($length = 10) {
	  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	  $count = mb_strlen($chars);
    for ($i = 0, $result = ''; $i < $length; $i++) {
      $index = rand(0, $count - 1);
      $result .= mb_substr($chars, $index, 1);
    }
	  return $result;
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
				'degree' => $_POST['degree'],
				'password' =>  $this->generatePassword() );
			if( $this->userModel->setUser($data) != NULL ){
				$to = $data['email'];
				$subject = "HTN: Account password for Heat Treatmen Network";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message = "<html><body>";
				$message .= "<h3>Your password is ".$data['password']." </h3>";
				$message .= "</body></html>";
				mail($to, $subject, $message, $headers);
			}
		}
		else {
			echo "error";
		}
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
