<?php
namespace Hagane\Controller;

class Downloads extends AbstractController{

	function _init() {
	}

  function index() {
  }

	function members() {
		if (!$this->auth->isAuth()) {
			header('Location:' . $this->config['document_root'] . 'login?dest=' . $this->config['document_root'] . 'Downloads/members');
			die();
		}
	}

}

?>
