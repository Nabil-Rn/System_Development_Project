<?php

include_once "Models/Client.php";

class HomeController{

	function route(){
            $this->render("index");

	}
    function render($view, $data = []) {

        include "Views/Home/$view.php";
    }
}

?>