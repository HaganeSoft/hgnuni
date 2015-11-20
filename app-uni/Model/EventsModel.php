<?php 
	namespace Hagane\Model;

	/**
	* Events
	*/
	class Events{
		private $db;

		function __construct(&$db) {
			if (!empty($id)) {
				$data = array('id' => $id);
				$userArray = $db->getRow('SELECT * from Events where Events.id = :id', $data);
				$this->db = $db;
			}
		}

		function getEvents() {
			$events = $this->db->query('SELECT * FROM Events');
			return $events;
		}

		function setEvents($data = array()) {
			$this->db->insert('INSERT INTO Events 
				SET area=:area, 
					eventDate=:eventDate,
			 		venue=:venue, 
			 		location=:location, 
			 		image=:image,
			 		link=:link ', $data);
		}

		function updateEvents($data = array()) {
			$this->db->query('UPDATE Events 
				SET area=:area, 
					eventDate=:eventDate, 
					venue=:venue, 
					location=:location,
					image=:image,
					link=:link WHERE id=:id', $data);
		}
	}
?>