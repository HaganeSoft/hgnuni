<?php 
namespace Hagane\Model;

/**
* Papers
*/
class Paper {
	private $db;

	function __construct(&$db) {
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from Papers where Papers.id = :id', $data);
			$this->db = $db;
		}
	}

	function getPapers() {
		$papers = $this->db->query('SELECT * FROM Papers');
		return $papers;
	}

	function setPapers($data = array()) {
		$this->db->insert('INSERT INTO Papers 
			SET area=:area, 
				title=:title,
		 		description=:description, 
		 		datePublished=:datePublished, 
		 		author=:author,
		 		image=:image,
		 		link=:link,
		 		members_only=:members_only ', $data);
	}

	function updatePapers($data = array()) {
		$this->db->query('UPDATE Papers 
			SET area=:area, 
				title=:title, 
				description=:description, 
				datePublished=:datePublished, 
				author=:author,
				image=:image,
				link=:link,
				members_only=:members_only WHERE id=:id', $data);
	}
}
?>