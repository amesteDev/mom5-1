<?php
//sets headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-with');

//includes the config-file, which in turn loads all class-files
include('config/config.php');
//sets up a variable $call equal to the request method.
$call = $_SERVER['REQUEST_METHOD'];
//sets up a new instance of the Querys class
$query = new Querys();

//a switch-statement that checks what type of method was used and does different calls/returns different data depending on the method
switch($call){
	case 'GET':
		$result = $query->getit();
		if (count($result) > 0){
			http_response_code(200);
		} else{
			http_response_code(404);
			$result = array("message" => "Nothing found in db");
		}
	break;

	case 'POST':
		$dataSet = json_decode(file_get_contents('php://input'));
		if($query->addCourse($dataSet->code, $dataSet->name, $dataSet->prog, $dataSet->syllabus)){
			http_response_code(201);
			$result = array("message" => "Record created");
		} else{
			http_response_code(503);
			$result = array("message" => "Something went wrong");
		}
	break;

	case 'PUT':
		$dataSet = json_decode(file_get_contents('php://input'));
		if($query->updateCourse($dataSet->code, $dataSet->name, $dataSet->prog, $dataSet->syllabus)){
			http_response_code(201);
			$result = array("message" => "Record updated");
		} else {
			http_response_code(500);
			$result = array("message" => "Something went wrong");
		}
	break;

	case 'DELETE':
		$dataSet = json_decode(file_get_contents('php://input'));
		if($query->deleteCourse($dataSet->code)){
			http_response_code(200);
			$result = array("message" => "Record deleted");
		} else{
			http_response_code(500);
			$result = array("message" => "Something went wrong");
		}

	break;
}

//send the data back as json
echo json_encode($result);