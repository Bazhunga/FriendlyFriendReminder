<?php
require_once("./dbinfo.php");
//This file allow user to add task to the todolist
$name = $_POST["name"];
$email = $_POST["email"];
//db connection
try{
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname",$dbusername,$dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO to throw exception
}
catch(PDOException $e){
    $msg = $e->getMessage();
    //generate an error msg
    $status = "failed";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}
//insertion
try{
    $pre = $db->prepare("INSERT INTO toDoList (name,email) VALUES(:name, :email)");
    $pre->execute(array(":name"=>"$name",":email"=>"$email"));
    $status = "succeeded";
    $msg = "Inserted Success";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}
catch(PDOException $e){
    $status = "failed";
    $msg = "Insertion Failed";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}
?>