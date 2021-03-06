<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
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
$devices->gwSN = isset($_GET['gwSN']) ? $_GET['gwSN'] : die();
//$data = json_decode(file_get_contents("php://input"));
// read the details of product to be edited

$devices->checkGwExist();

if(!empty($devices->gwSN))
{
    //$devices->gwSN = $data->gwSN;
    //echo json_encode($data);
    $stmt =$devices->getDevice();
   // query products
 $num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0)
{
    $devArr=array();
    $devArr["Devices"]=array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

       $devicesArr = array(
                     "devID" => $devID,
                    "devSN" => $devSN,
                    "devName" => $devName,
                    "devRegisterDate" => $devRegisterDate,
                    "devExpiryDate" => $devExpiryDate,
        );
 
        array_push( $devArr["Devices"], $devicesArr);
    } 
    // // set response code - 200 OK
    http_response_code(200);
    echo json_encode(array("Status" => "Gateway exist."));
    echo json_encode($devArr);
 
    // // show products data in json format
    // echo json_encode($products_arr);
}
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Gateway does not exist."));
}