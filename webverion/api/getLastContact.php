<?php
require_once("./dbinfo.php");
//This file allow user to add task to the todolist
$id = $_POST["id"];
//db connectiont
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
//get LastContact
try{
    $pre = $db->prepare("SELECT * FROM friend WHERE id=:id");
    $pre->execute(array(":id"=>"$id"));
    $row = $pre->fetch();
    $msg = $row['lastContact'];
    $status = "succeeded";
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