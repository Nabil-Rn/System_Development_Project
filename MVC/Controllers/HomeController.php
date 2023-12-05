<?php

include_once "Models/Client.php";

class HomeController{

	function index(){
            $this->render("index");

	}
    function render($view, $data = []) {

        include "Views/Home/$view.php";
    }
}

?>