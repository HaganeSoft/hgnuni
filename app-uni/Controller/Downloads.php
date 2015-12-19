<?php
namespace Hagane\Controller;

class Downloads extends AbstractController{

	function _init() {
	}

  function index() {
  }

  	function download(){
	  	if( $this->auth->isAuth() ){
		  	$path_parts = pathinfo($_GET['file']);
		  	$file_name  = $path_parts['basename'];
		  	$file_path  = '/Documents/' . $file_name;
		  	header("Content-type: application/pdf");
		  	header("Content-Disposition: attachment; filename=$file_path");
	  	} else {
	  		die("None shall pass");
	  	}
  	}

}

?>
