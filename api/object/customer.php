<?php
class customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "customer";
 
    // object properties
    public $custID;
    public $custName;
    public $custEmail;
    public $custPhone;
    public $custAddress;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

function addCust(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                custName=:custName, custEmail=:custEmail, custPhone=:custPhone, custAddress=:custAddress";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
    // bind values
    $stmt->bindParam(":custName", $this->custName);
    $stmt->bindParam(":custEmail", $this->custEmail);
    $stmt->bindParam(":custPhone", $this->custPhone);
    $stmt->bindParam(":custAddress", $this->custAddress);

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    



}


?>