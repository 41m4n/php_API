<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/db.php';
 
// instantiate product object
include_once '../object/customer.php';
 
$database = new Database();
$db = $database->getConnection();
 
$customer = new Customer($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->custName) &&
    !empty($data->custEmail) &&
    !empty($data->custPhone) &&
    !empty($data->custAddress)
){
 
    // set product property values
    $customer->custName = $data->custName;
    $customer->custEmail = $data->custEmail;
    $customer->custPhone = $data->custPhone;
    $customer->custAddress = $data->custAddress;

 
    // create the product
    if($customer->addCust()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>