<?php
require_once("./dbinfo.php");
//This api delete a friend
$id = $_GET['id'];

//connect to DB
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

//delete query
try{
    $pre = $db->prepare("DELETE FROM friend WHERE id=:id");
    $pre->execute(array(":id"=>"$id"));
    //return status object
    $msg = "Delete Successfully";
    $status = "suceeded";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}
catch(PDOException $e){
    $msg = $e->getMessage();
    //generate an error msg
    $status = "failed";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}
?>