<?php

interface Crud {
  public function create();
  public function get all();
  public function get one();
  public function update();
  public function delete();

}

class CustomerCrud {
  public function create(){
    $date = date("Y.m.d H:i:s");
    $name = escapeInsert($conn, $_POST['txtName']);
    $email = escapeInsert($conn, $_POST['txtEmail']);
    $password = escapeInsert($conn, $_POST['txtPassword']);
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO customer
                (customerName, CustomerEmail, customerPassword, customerDate)
                VALUES('$name', '$email', '$passwordHash', '$date');
    $result = mysqli_query($conn, $query) or die ("Query failed $query");
    $insId = mysqli_insert_id($conn);
    
    return $insId
  }
  public function get_all(){
    $query = "SELECT * FROM customer ORDER BY customerName ASC"
    $result = mysqli_query($conn, $query) or die ("Query failed")
    return $result;
  }
  public function get_one(){
    $query = "SELECT * FROM customer
    WHERE customerId=". $customerId;
    $result = mysqli_query($conn, $query) Or Die("Query failed: $query");
 }
  public function update(){
    $name = escapeInsert($conn, $_POST['txtName']);
    $email = escapeInsert($conn, $_POST['txtEmail']);
    $editId = $_POST['updateid'];
    
    $query = "UPDATE customer
    SET customerName='$name', customerEmail = '$email'
    WHERE customerID = "$editid";

    $result = mysqli_query($conn, $query) or die("Query failed: $query");
  }
  public function delete(){
     $query = "DELETE FROM customer WHERE customerId=". $customerId;
    $result= mysqli_query($conn, $query) or die ("Query failed: $query");
  }
private function escapeInsert($conn, $insert){
    $insert = htmlspecialchars($insert);
    $insert = mysqli_real_escape_string($conn, $insert);

    return $insert;
    }
 ?>
