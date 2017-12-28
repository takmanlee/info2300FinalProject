<?php
require_once 'config/config.php';
	if(session_status()==1){
		session_start();
	}
if(isset($_GET['user'])&&isset($_GET['group'])){
	$user = $_GET['user'];
	$group = $_GET['group'];
	if($user == $_SESSION["name"] && $user!='guest' && $group!='1'){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$newList = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT groupList FROM users WHERE username='$user'"))['groupList'] . " $group";
		if(substr_count($newList, " $group")>1){
			$newList = str_replace(" $group", '', $newList);
		}
		mysqli_query($mysqli, "UPDATE users SET groupList='$newList' WHERE username = '$user'"); 
	}
}
header("Location: ".$_SESSION["page"]);
?>