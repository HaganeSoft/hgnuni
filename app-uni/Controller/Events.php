<?php 
namespace Hagane\Controller;

class Events extends AbstractController{
	
	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {
	}

	function ajaxSetEvents() {
		$this->print_template = false;
		$this->sendJson = true;
		$this->eventsModel = new \Hagane\Model\EventsModel($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'area' => $_POST['area'],
				'eventDate' => $_POST['eventDate'],
				'venue' => $_POST['venue'],
				'location' => $_POST['location'],
				'image' => $_POST['image'],
				'link' => $_POST['link']);

				$this->eventsModel->setEvents($data);
		}
	}

	function ajaxUpdateEvents() {
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->sendJson = true;
		$this->print_template = false;
		$this->eventsModel = new \Hagane\Model\EventsModel($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'id' => $request->id,
				'area' => $request->area,
				'eventDate' => $request->eventDate,
				'venue' => $request->venue,
				'location' => $request->location,
				'image' => $request->image,
				'link' => $request->link);
			$this->eventsModel->updateEvents($data);
		}
	}

	function ajaxGetEvents() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->eventsModel = new \Hagane\Model\EventsModel($this->auth, $this->db);
		echo json_encode($this->eventsModel->getEvents());
	}
}
?>