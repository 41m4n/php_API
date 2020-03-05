<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/db.php';
include_once '../object/devices.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$devices = new Devices($db);
 
// set ID property of record to read
//$devices->gwSN = isset($_GET['gwSN']) ? $_GET['gwSN'] : die();
//$data = json_decode(file_get_contents("php://input"));
// read the details of product to be edited
$data = json_decode(file_get_contents("php://input"));
echo json_encode($data);
$devices->devSN = $data->devSN;
//ECHO "LLK ".$data->devSN;
//ECHO "LLK ".$devices->devSN;
//$devices->checkDevExist()

if(!empty($devices->devSN))
{
  
    foreach($devices->devSN as $test ){

        echo $test." ";
    

        if($devices->checkDevExist($test))
        {

    
            http_response_code(200);
            echo json_encode(array("Status" => "Device exist."));
            //echo json_encode($devArr);
        }
        

        else
        {
            // tell the user product does not exist
            $devices->insertNewDevices($test);
            echo json_encode(array("Status" => "Device nOT eXIST."));
        }

    }
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
   // $devices->insertNewDevices();
   echo json_encode(array("Status" => "No value."));

  // $devices->devSN

}

?>