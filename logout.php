<?php	
	if(session_status()==1){
		session_start();
	}
	$_SESSION["name"]='guest';
	header("Location: ".$_SESSION["page"]);
?>