<?php
if(isset($_POST['name'])){
$name = $_POST['name'];}
if(isset($_POST['course'])){
$course = $_POST['course'];}
if(isset($_POST['gender'])){
$gender = $_POST['gender'];}
$email = $_POST['email'];
if(isset($_POST['password'])){
$password = $_POST['password'];}
if(isset($_POST['Re-type password'])){
$retypepassword = $POST['Re-type password'];}
if(isset($_POST['phone no'])){
$phoneno = $POST['phone no'];}
if(isset($_POST['name'])){
$address = $POST['address'];}
if (!empty($name) || !empty($course) || !empty($gender) || !empty($email) || !empty($password) || !empty($retypepassword) || !empty($phoneno) || !empty($address)) 
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "243Formation.";
    $dbname = "improve";
    //create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (name, course, gender, email, password, retypepassword, phoneno, address) values(?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssis", $name, $course, $gender, $email, $password, $retypepassword, $phoneno, $address);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already registered using this email";
     }
     $stmt->close();
     $conn->close();
    }
}
 else {
 echo "All field are required";
 die();
}
?>