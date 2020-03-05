<?php
class Gateway{
 
    // database connection and table name
    private $conn;
    private $table_name = "gateway";
 
    // object properties
    public $gwSN;
    public $gwRegisterDate;
    public $gwExpiryDate;
    public $custID;

    public function __construct($db){
        $this->conn = $db;
    }

    function postGwSN()
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



}