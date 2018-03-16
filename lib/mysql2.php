<?php
  function connect_db() {  
    $server = 'localhost'; // this may be an ip address instead  
    $user = 'root';  
    $pass = '134679852a';  
    $database = 'news'; // name of your database  
    $connection = new mysqli($server, $user, $pass, $database);  
    $connection->set_charset("utf8");
    if ($connection->connect_error) {
		$err='{"status":$err}';
		$err=json_decode($err);
		echo $err;
	}
	return $connection;
}

 
?>	