<?php

class HomeController{

	function route(){

        $action = (isset($_GET['action'])) ? $_GET['action'] : "index";
        $this->render($action);
	}

    function render($view) {

        include "Views/Home/$view.php";
    }
}

?>