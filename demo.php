<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once './src/QcloudApi/QcloudApi.php';
require 'lib/mysql2.php';  
$config = array('SecretId'        => 'AKIDxpW1LUxO5awAD0vPuDLH3e9XJwWwsD4j',
             'SecretKey'       => 'kMn26EGallaEgzAB2hARX0HOODqHe3Qn',
             'RequestMethod'  => 'POST',
             'DefaultRegion'    => 'gz');

$wenzhi = QcloudApi::load(QcloudApi::MODULE_WENZHI, $config);
  $db = connect_db();  
    $sql = "SELECT * FROM analysis where positive is null";  
    $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    //var_dump($data[0]["content"]);
    $db = null;  
$content=$data[0]["content"];
$id=$data[0]["id"];
$package = array("content"=>$content);

$a = $wenzhi->TextSentiment($package);

if ($a === false) {
    $error = $wenzhi->getError();
    echo "Error code:" . $error->getCode() . ".n";
    echo "message:" . $error->getMessage() . ".n";
    echo "ext:" . var_export($error->getExt(), true) . ".n";
} else {
    var_dump($a);
    //echo json_encode($a);
     $db = connect_db();  
    $positive=$a["positive"];
   $sql="update analysis set positive=$positive where id='$id'";
    $exe = $db->query($sql);  
    $db = null;
    
}

//echo "nRequest :" . $wenzhi->getLastRequest();
//echo "nResponse :" . $wenzhi->getLastResponse();
//echo "n";
