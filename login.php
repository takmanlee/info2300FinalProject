<div class="loginBar">
<?php
	if(session_status()==1){
		session_start();
	}
	if(isset($_SESSION["name"]) && $_SESSION['name']!='guest'){
		echo "<span id='nameBar'>$_SESSION[name]  -  <a href='logout.php'>Logout</a></span>";
		
    } else { 
    	echo '<h3> LOGIN </h3>
        <form id="loginForm" name="loginForm" action="login.php" method="post">
        	Username: <input type="text" name="username"><br><br>
        	Password: <input type="password" name="password"><br><br>
        	<input type="submit">
        </form>
        ';
	}
?>
<?php 
	require_once 'config/config.php';
	if(isset($_POST["password"]) && $_POST["username"]!='guest'){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$username = mysqli_real_escape_string($mysqli, htmlentities($_POST["username"]));
		$query = mysqli_query($mysqli, "SELECT password FROM users WHERE username='".$username."'") or die(mysqli_error($mysqli));
		$clientpass = mysqli_real_escape_string($mysqli, htmlentities($_POST['password']));//password_hash($_POST["password"], PASSWORD_DEFAULT);
		$serverpass = mysqli_fetch_assoc($query)["password"];
		if(password_verify($clientpass, $serverpass)){
			$_SESSION["name"] = mysqli_real_escape_string($mysqli, htmlentities($username));
			header("Location: ".$_SESSION["page"]);
		}
		else{
			header("Location: ".$_SESSION["page"]);
		}
	}

	
?>
</div>