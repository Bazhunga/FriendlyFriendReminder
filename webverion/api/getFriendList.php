<?php
//this API return the list of friends in json format

require_once("./dbinfo.php");
//connect to DB via PDO
try{
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname",$dbusername,$dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO to throw exception
}
catch(PDOException $e){
    echo $e->getMessage();
}
//select all the task
try{
    $pre = $db->prepare("SELECT * FROM friend");
    $pre->execute();
    //initiate a numeric array to store all the task json object
    $arrayJson = array();
    while($row = $pre->fetch()){
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $lastContact = $row['lastContact'];
        $videoMsg = $row['videoMsg'];
        //initialize individual element and push it to the return arrayJson
        $jsonElement = array("id"=>"$id","name"=>"$name","email"=>"$email","lastContact"=>"$lastContact","videoMsg"=>"$videoMsg");
        array_push($arrayJson,$jsonElement);
    }
    //encode the actual json string
    $jsonObj = json_encode($arrayJson);
    echo $jsonObj;
}
catch(PDOException $e){
    echo $e->getMessage();
}

?>