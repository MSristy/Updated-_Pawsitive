<?php 
    
    
	$conn = mysqli_connect('localhost', 'root', '', 'paw');

	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>