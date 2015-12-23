<?php
namespace Hagane\Controller;

class Downloads extends AbstractController{

	function _init() {
	}

	function index() {
	}

	function download(){
		$this->print_template = false;
		$this->specifyHeader = true;

		if( !$this->auth->isAuth() ){
			$path_parts = pathinfo($_GET['file']);
			$file_name  = $path_parts['basename'];
			$file_path  = $this->config['appPath'].'/Documents/' . $file_name;
		    header('Content-Type: application/pdf');
			header('Content-Description: File Transfer');
		    header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file_path));
			//header("Content-Disposition: attachment; filename=$file_name");
			readfile($file_path);
		} else {
			die("None shall pass");
		}
	}

}

?>
