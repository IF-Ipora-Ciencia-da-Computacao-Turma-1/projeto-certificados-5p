<?php 
	$hostname = "localhost";
	$database = "certifica";
	$user = "root";
	$password = "";
	
	$connection = mysqli_connect($hostname, $user, $password, $database);

	if(!$connection){
		die("Houve um erro: ".mysqli_connect_error());
	}

    function teste() {
        echo "testando";
    }
?>

