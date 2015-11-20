<?php 
	namespace Hagane\Controller;

	class Papers extends AbstractController{
		
		function _init() {
			if (!$this->auth->isAuth()) {
				 header("Location:" . $this->config['document_root'] . "Papers");
				 die();
			}
			include_once($this->config['appPath'].'Model/PapersModel.php');
			echo $this->db->database_log['error'];
		}

		function index() {
		}

		function ajaxSetPapers() {
			$this->print_template = false;
			$this->sendJson = true;
			$this->papersModel = new \Hagane\Model\PapersModel($this->auth, $this->db);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = array(
					'area' => $_POST['area'],
					'title' => $_POST['title'],
					'description' => $_POST['description'],
					'datePublished' => $_POST['datePublished'],
					'author' => $_POST['author'],
					'image' => $_POST['image'],
					'link' => $_POST['link'],
					'members_only' => $_POST['members_only']);

					$this->papersModel->setPapers($data);
			}
		}

		function ajaxUpdatePapers() {
			$postdata = file_get_contents("php://input"); //recibe los datos de angular
			$request = json_decode($postdata);

			$this->sendJson = true;
			$this->print_template = false;
			$this->papersModel = new \Hagane\Model\PapersModel($this->auth, $this->db);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = array(
					'id' => $request->id,
					'area' => $request->area,
					'title' => $request->title,
					'description' => $request->description,
					'datePublished' => $request->datePublished,
					'author' => $request->author,
					'image' => $request->image,
					'link' => $request->link,
					'members_only' => $request->members_only);
				$this->papersModel->updatePapers($data);
			}
		}

		function ajaxGetPapers() {
			$this->sendJson = true;
			$this->print_template = false;
			$this->papersModel = new \Hagane\Model\PapersModel($this->auth, $this->db);
			echo json_encode($this->papersModel->getPapers());
		}
	}
?>