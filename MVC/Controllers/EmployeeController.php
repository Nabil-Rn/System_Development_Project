<?php

include_once "Models/Employee.php";

class EmployeeController{

	function route(){

		$controller = $_GET['controller'];
		$action = (isset($_GET['action'])) ? $_GET['action'] : "index";
		$id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;
		
		
//		$user = new User($id);
//		$this->render("view", array($user));

        if($action == "index"){
            // get all employees
            $employees = Employee::listEmployeees();
            $this->render("index", $employees);
        }
        else{
            $employee = new Employee($id);
            $this->render($action, array($employee));
        }

	}
	
    function render($view, $data = []) {
        extract($data);

        include "Views/Employee/$view.php";
    }
}

?>