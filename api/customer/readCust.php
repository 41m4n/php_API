<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/db.php';
include_once '../object/customer.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
// query products
$stmt = $customer->readCust();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $customer_arr=array();
    $customer_arr["allCust"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $customer_item=array(
            "custID" => $custID,
            "custName" => $custName,
            "custEmail" =>$custEmail ,
            "custPhone" => $custPhone,
            "custAddress" => $custAddress
        );
 
      
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($customer_arr);
}
 
// no products found will be here
?>