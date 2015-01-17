<?php
//get or update videoMsg token
//connct to Database
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
    die();
}

$method = $_POST['method'];
$id = $_POST['userid'];

if($method == "update"){
    try{
        $lastContact = $_POST['lastContact'];
        $pre = $db->prepare("UPDATE friend SET lastContact=:lastContact WHERE id=:id");
        $pre->execute(array(":lastContact"=>"$lastContact",":id"=>"$id"));
        $status = "succeeded";
        $msg = "Updated Success";
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
}
elseif($method == "get"){
    try{
        $pre = $db->prepare("SELECT * FROM friend WHERE id=:id");
        $pre->execute(array(":id"=>"$id"));
        $row = $pre->fetch();
        $status = "suceeded";
        $msg = $row['lastContact'];
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
}
else{
    $msg = "Wrong Method";
    $status = "failed";
    $result = array("msg"=>"$msg","status"=>"$status");
    echo json_encode($result);
}

?>