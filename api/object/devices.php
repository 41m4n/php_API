<?php
class Devices{
 
    // database connection and table name
    private $conn;
    private $table_name = "devices";
 
    // object properties
    public $gwSN;
    public $devSN;
    public $devName;
    public $devRegisterDate;
    public $devExpiryDate;

    public function __construct($db){
        $this->conn = $db;
    }
function checkGwExist()
{
    $query = "SELECT
    gwSN
  FROM
      " . $this->table_name . "
  WHERE
      gwSN = ?
  LIMIT
      0,1";

// prepare query statement
$stmt = $this->conn->prepare( $query );

// bind id of product to be updated
$stmt->bindParam(1, $this->gwSN);

// execute query
$stmt->execute();

// get retrieved row
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// set values to object properties
$this->gwSN = $row['gwSN'];

}

function checkDevExist($serialNo)
{
    $query = "SELECT devSN FROM " . $this->table_name . " WHERE  devSN = :serialNo LIMIT 0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(':serialNo', $serialNo);

    // execute query
    $stmt->execute();

    if($stmt->rowCount() > 0){
        return true;
    }else{
        return false;        
    }
    // get retrieved row
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    //$this->devSN = $row['devSN'];
    

}

    function getDevice()
   {

    $query="SELECT
 devID,devSN,devName,devRegisterDate,devExpiryDate
FROM
    " . $this->table_name . " 
WHERE
    gwSN=:gwSN";

      $stmt = $this->conn->prepare( $query );
      $stmt->bindParam(":gwSN", $this->gwSN);
// bind id of product to be updated
//$stmt = $this->conn->prepare( $query );
$stmt->execute();

return $stmt;
    }
function insertNewDevices($serialNo)
{
    // foreach($this->devSN as $tes ){

    //     echo $test." ";
    // }
    $modelCode = substr($serialNo,0,4);

    echo "Model Code:".$modelCode;

    $query = "SELECT * FROM warrantylist WHERE  pCode LIKE '%$modelCode%' LIMIT 1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );     

    // execute query
    $stmt->execute(); 

    if($stmt->rowCount() > 0){

        echo "Found";
        
        $row= $stmt->fetch(PDO::FETCH_ASSOC);

        echo "asdasdsad".$row["pName"];

        $query = "INSERT INTO devices (devSN,devName,devRegisterDate,devExpiryDate,gwSN) values(:devSN,:devName,:devRegisterDate,:devExpiryDate,:gwSN)";
            //$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        // prepare query
        $stmt = $this->conn->prepare($query);
        $this->gwSN = "ID01-12345-1111";
        $curDate = date('Y-m-d H:i:s');
        $this->devRegisterDate = date('Y-m-d',strtotime($curDate));
        echo "ttt ".$this->devRegisterDate;
        $stmt->bindParam(":devSN", $serialNo);
        $stmt->bindParam(":devName", $row["pName"]);
        $stmt->bindParam(":devExpiryDate", $this->devExpiryDate);
        $stmt->bindParam(":gwSN", $this->gwSN);
        $stmt->bindParam(":devRegisterDate", $this->devRegisterDate);

        // execute query
        if($stmt->execute()){
            echo "Success Insert";
            return true;
        }else{
            print_r($stmt->errorInfo());
            echo "Fail Insert";
        }
        
    }else{
        echo "Not Found";
    }

    //echo $row[2];
    
    

return false;
}

// function getDeviceDetails()
// {
//    $query="SELECT pName,pWarrantyYear FROM warrantylist where pCode like '%$devSN%' FROM warrantylist";

//    $query="INSERT INTO devices(devSN,devName,devRegisterDate,devExpiryDate,gwSN)
//             SELECT 'ST02-12345-1111',p.pName,CURDATE(),p.pWarrantyYear,'ID01-12345-1111'
//             FROM warrantyList p
//             WHERE 'ST04-1234-1233' LIKE CONCAT ('%', W.pCode, '%')";

//             $query="SELECT  FROM devices d , warrantylist w WHERE 'ST04-1234-1233' LIKE CONCAT ('%', W.pCode, '%')";

   
// INSERT INTO devices(devSN,devName,devRegisterDate,devExpiryDate,gwSN) 
// SELECT 'ST01-12345-1111',p.pName,CURDATE(),p.pWarrantyYear,'ID01-12345-1111' 
// FROM warrantyList p WHERE 'ST01-12345-1111' LIKE CONCAT ('%', p.pCode, '%');
// }

}