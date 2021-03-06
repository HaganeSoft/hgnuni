<?php
namespace Hagane\Model;

/**
* Papers
*/
class Papers {
	private $db;

	function __construct(&$db) {
		// if (!empty($id)) {
		// 	$data = array('id' => $id);
		// 	$userArray = $db->getRow('SELECT * from Papers where Papers.id = :id', $data);
		// }
		$this->db = $db;
	}

	function getPapers() {
		$papers = $this->db->query('SELECT * FROM Paper');
		return $papers;
	}

	function setPapers($data = array()) {
		$this->db->insert('INSERT INTO Paper
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
		$this->db->query('UPDATE Paper
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